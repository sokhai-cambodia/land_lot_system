<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;
use App\DocumentInstallment;
use App\InstallmentPayment;
use Auth;
use DB;
use NotificationHelper;
use File;
use FileHelper;

class DocumentInstallmentController extends Controller
{
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function index($installmentId)
    {

        $installment = InstallmentPayment::find($installmentId);
        if($installment == null) {
            NotificationHelper::setErrorNotification('Invalid InstallmentPayment');
            return redirect()->back();
        }

        $data = [
            'title' => 'List Document InstallmentPayment',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => ucfirst($installment->role), 'route' => 'installment.'.$installment->role, 'class' => ''],
                ['name' => 'Document InstallmentPayment', 'route' => 'document.installment', 'class' => 'active']
            ],
            'installment' => $installment
        ];
        return view('admin.document.installment.index')->with($data);
    }

    public function create($installmentId)
    {
        $installment = InstallmentPayment::find($installmentId);
        if($installment == null) {
            NotificationHelper::setErrorNotification('Invalid InstallmentPayment');
            return redirect()->back();
        }

        $data = [
            'title' => 'Upload Document',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Document InstallmentPayment', 'route' => 'document.installment', 'routeParam' => ['installmentId' => $installment->id], 'class' => ''],
                ['name' => 'Upload Document', 'route' => 'document.installment.create', 'class' => 'active']
            ],
            'installmentId' => $installment->id
        ];
        return view('admin.document.installment.create')->with($data);
    }

    public function store(Request $request, $installmentId) 
    {
        $installment = InstallmentPayment::find($installmentId);
        if($installment == null) {
            NotificationHelper::setErrorNotification('Invalid InstallmentPayment');
            return redirect()->back();
        }
        
        $request->validate([
            'files' => 'required|min:1',
            'names' => 'required|min:1',
            'descriptions' => 'required|min:1',
        ]);
        $uploadedPath = [];
        try 
        {   
            DB::transaction(function () use($request, $installment, &$uploadedPath) {
                $data = [];
                $unique_code = Auth::id().'-'.time().'-'.uniqid();
                if($request->hasFile('files'))
                {
                    $folder = '/assets/uploads/documents/installment';
                    $files = $request->file('files');
                    $ind = 0;
                    foreach ($files as $file) {
                        $filename = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $size = $file->getClientSize();
                        $data[] = [
                            'company_id' => Auth::user()->company_id,
                            'name' => $request->names[$ind],
                            'description' => $request->descriptions[$ind],
                            'folder' => $folder,
                            'original_file_name' => $filename,
                            'extension' => $extension,
                            'size' => $size,
                            'unique_code' => $unique_code,
                            'created_by' => Auth::id()
                        ];
                        $uploadName = Auth::id().'-'.time().'-'.uniqid().$filename;
                        $uploadedPath[] = public_path().$folder.'/'.$uploadName;
                        $file->move(public_path().$folder, $uploadName);
                        $ind++;
                    }
                }

                
                if(count($data) > 0) {
                    Document::insert($data); // insert documents
                    $docs = Document::where('unique_code', $unique_code)->select('id')->get();
                    $docInstallmentPayments = [];
                    foreach($docs as $doc) {
                        $docInstallmentPayments[] = [
                            'installment_id' => $installment->id,
                            'document_id' => $doc->id
                        ];
                    }

                    DocumentInstallment::insert($docInstallmentPayments); // insert documents installment
                }
            });
            NotificationHelper::setSuccessNotification('Upload success');
            return redirect()->route('document.installment', ['installmentId' => $installment->id]);
        }
        catch (\Exception $e) 
        {
            // delete uploaded file if have error
            if(count($uploadedPath) > 0) {
                foreach($uploadedPath as $up) {
                    if(File::exists($up)) {
                        File::delete($up);
                    }
                }
            }

            // NotificationHelper::errorNotification($e);
            NotificationHelper::setErrorNotification('Error: '.$e->getMessage());
            return back()->withInput();
        }
        

    }

    public function edit($installmentId, $id)
    {
        
        $installment = InstallmentPayment::find($installmentId);
        if($installment == null) {
            NotificationHelper::setErrorNotification('Invalid InstallmentPayment');
            return redirect()->back();
        }

        $doc = Document::find($id);
        if($doc == null) {
            NotificationHelper::setErrorNotification('Invalid Document');
            return redirect()->back();
        }

        
        $data = [
            'title' => 'Upload Document',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Document InstallmentPayment', 'route' => 'document.installment', 'routeParam' => ['installmentId' => $installment->id], 'class' => ''],
                ['name' => 'Edit Document', 'route' => 'document.installment.update', 'routeParam' => ['installmentId' => $installment->id, 'id' => $id], 'class' => 'active']
            ],
            'installmentId' => $installment->id,
            'row' => $doc
        ];
        return view('admin.document.installment.edit')->with($data);
    }

    public function update(Request $request, $installmentId, $id) 
    {
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $installment = InstallmentPayment::find($installmentId);
        if($installment == null) {
            NotificationHelper::setErrorNotification('Invalid InstallmentPayment');
            return redirect()->back();
        }
        
        $doc = Document::find($id);
        if($doc == null) {
            NotificationHelper::setErrorNotification('Invalid Document');
            return redirect()->back();
        }
        $doc->name = $request->name;
        $doc->description = $request->description;
        $doc->save();

        NotificationHelper::setSuccessNotification('Update success');
        return redirect()->route('document.installment', ['installmentId' => $installment->id]);
    }

    
    // Ajax with datatable
    public function dataTable(Request $request, $installmentId)
    {
       

        $installment = InstallmentPayment::find($installmentId);
        if($installment == null) {
            NotificationHelper::setErrorNotification('Invalid InstallmentPayment');
            return redirect()->back();
        }
        
        $draw = $request['draw'];
        $row = $request['start'];
        $rowPerPage = $request['length']; // Rows display per page
        $columnIndex = $request['order'][0]['column']; // Column index
        $columnName = $request['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $request['order'][0]['dir']; // asc or desc
        $searchValue = $request['search']['value']; // Search value
        
        
        //  Search 
        $searchQuery = " ";
        if($searchValue != ''){
            $searchQuery = " and (document.name like "."'%$searchValue%'".") ";
        }

        //  Total number of records without filtering
        //  $totalRecords = InstallmentPayment::where('role', $role)->where('status', 'active')->count();

        //  Total number of record with filtering
        $totalRecordwithFilter = Document::join('document_installments', 'document_installments.document_id', '=', 'documents.id')
                                    ->whereRaw('1=1'.$searchQuery)
                                    ->where('document_installments.installment_id', $installment->id)
                                    ->count();
        
        ## Fetch records
        $records = Document::join('document_installments', 'document_installments.document_id', '=', 'documents.id')
                    ->whereRaw('1=1'.$searchQuery)
                    ->where('document_installments.installment_id', $installment->id)
                    ->select('documents.*')
                    ->orderBy('documents.'.$columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            $extension = FileHelper::getFileIcon($record->extension);
            $routeEdit = route('document.installment.update', ['installmentId' => $installment->id, 'id' => $record->id]);
            $data[] = [
                "folder" => $record->folder,
                "name" => $record->name,
                "description" => $record->description,
                "extension" => "<img src='$extension' alt='$record->extension' style='width: 30px; height: 30px'/>",
                "size" => $record->size,
                "action" => "<div class='btn-group'>
                                <a href='$routeEdit' class='btn btn-default btn-sm' title='Edit'><i class='far fa-edit'></i></a>
                                <button type='button' data-url='#' class='btn btn-default btn-sm btn-delete' title='Inactive'><i class='fas fa-toggle-on'></i></button>
                            </div>",
            ];
        }

        ## Response
        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        ];
        
        return response()->json($response);

    }

    
}
