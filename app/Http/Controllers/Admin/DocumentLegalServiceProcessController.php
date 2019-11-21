<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;
use App\DocumentLegalServiceProcess;
use App\LegalServiceProcess;
use Auth;
use DB;
use NotificationHelper;
use File;
use FileHelper;

class DocumentLegalServiceProcessController extends Controller
{
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function index($processId)
    {

        $process = LegalServiceProcess::find($processId);
        if($process == null) {
            NotificationHelper::setErrorNotification('Invalid LegalServiceProcess');
            return redirect()->back();
        }

        $data = [
            'title' => 'List Document LegalServiceProcess',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => ucfirst($process->role), 'route' => 'process.'.$process->role, 'class' => ''],
                ['name' => 'Document LegalServiceProcess', 'route' => 'document.process', 'class' => 'active']
            ],
            'process' => $process
        ];
        return view('admin.document.process.index')->with($data);
    }

    public function create($processId)
    {
        $process = LegalServiceProcess::find($processId);
        if($process == null) {
            NotificationHelper::setErrorNotification('Invalid LegalServiceProcess');
            return redirect()->back();
        }

        $data = [
            'title' => 'Upload Document',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Document LegalServiceProcess', 'route' => 'document.process', 'routeParam' => ['processId' => $process->id], 'class' => ''],
                ['name' => 'Upload Document', 'route' => 'document.process.create', 'class' => 'active']
            ],
            'processId' => $process->id
        ];
        return view('admin.document.process.create')->with($data);
    }

    public function store(Request $request, $processId) 
    {
        $process = LegalServiceProcess::find($processId);
        if($process == null) {
            NotificationHelper::setErrorNotification('Invalid LegalServiceProcess');
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
            DB::transaction(function () use($request, $process, &$uploadedPath) {
                $data = [];
                $unique_code = Auth::id().'-'.time().'-'.uniqid();
                if($request->hasFile('files'))
                {
                    $folder = '/assets/uploads/documents/process';
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
                    $docLegalServiceProcesss = [];
                    foreach($docs as $doc) {
                        $docLegalServiceProcesss[] = [
                            'legal_service_process_id' => $process->id,
                            'document_id' => $doc->id
                        ];
                    }

                    DocumentLegalServiceProcess::insert($docLegalServiceProcesss); // insert documents process
                }
            });
            NotificationHelper::setSuccessNotification('Upload success');
            return redirect()->route('document.process', ['processId' => $process->id]);
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

    public function edit($processId, $id)
    {
        
        $process = LegalServiceProcess::find($processId);
        if($process == null) {
            NotificationHelper::setErrorNotification('Invalid LegalServiceProcess');
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
                ['name' => 'Document LegalServiceProcess', 'route' => 'document.process', 'routeParam' => ['processId' => $process->id], 'class' => ''],
                ['name' => 'Edit Document', 'route' => 'document.process.update', 'routeParam' => ['processId' => $process->id, 'id' => $id], 'class' => 'active']
            ],
            'processId' => $process->id,
            'row' => $doc
        ];
        return view('admin.document.process.edit')->with($data);
    }

    public function update(Request $request, $processId, $id) 
    {
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $process = LegalServiceProcess::find($processId);
        if($process == null) {
            NotificationHelper::setErrorNotification('Invalid LegalServiceProcess');
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
        return redirect()->route('document.process', ['processId' => $process->id]);
    }

    
    // Ajax with datatable
    public function dataTable(Request $request, $processId)
    {
       

        $process = LegalServiceProcess::find($processId);
        if($process == null) {
            NotificationHelper::setErrorNotification('Invalid LegalServiceProcess');
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
        //  $totalRecords = LegalServiceProcess::where('role', $role)->where('status', 'active')->count();

        //  Total number of record with filtering
        $totalRecordwithFilter = Document::join('document_legal_service_processes', 'document_legal_service_processes.document_id', '=', 'documents.id')
                                    ->whereRaw('1=1'.$searchQuery)
                                    ->where('document_legal_service_processes.legal_service_process_id', $process->id)
                                    ->count();
        
        ## Fetch records
        $records = Document::join('document_legal_service_processes', 'document_legal_service_processes.document_id', '=', 'documents.id')
                    ->whereRaw('1=1'.$searchQuery)
                    ->where('document_legal_service_processes.legal_service_process_id', $process->id)
                    ->select('documents.*')
                    ->orderBy('documents.'.$columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            $extension = FileHelper::getFileIcon($record->extension);
            $routeEdit = route('document.process.update', ['processId' => $process->id, 'id' => $record->id]);
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
