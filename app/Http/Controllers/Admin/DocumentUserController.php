<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Document;
use App\DocumentUser;
use App\User;
use Auth;
use DB;
use NotificationHelper;
use File;
use FileHelper;

class DocumentUserController extends Controller
{
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function index($userId)
    {

        $user = User::find($userId);
        if($user == null) {
            NotificationHelper::setErrorNotification('Invalid User');
            return redirect()->back();
        }

        $data = [
            'title' => 'List Document User',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => ucfirst($user->role), 'route' => 'user.'.$user->role, 'class' => ''],
                ['name' => 'Document User', 'route' => 'document.user', 'class' => 'active']
            ],
            'user' => $user
        ];
        return view('admin.document.user.index')->with($data);
    }

    public function create($userId)
    {
        $user = User::find($userId);
        if($user == null) {
            NotificationHelper::setErrorNotification('Invalid User');
            return redirect()->back();
        }

        $data = [
            'title' => 'Upload Document',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Document User', 'route' => 'document.user', 'routeParam' => ['userId' => $user->id], 'class' => ''],
                ['name' => 'Upload Document', 'route' => 'document.user.create', 'class' => 'active']
            ],
            'userId' => $user->id
        ];
        return view('admin.document.user.create')->with($data);
    }

    public function store(Request $request, $userId) 
    {
        $user = User::find($userId);
        if($user == null) {
            NotificationHelper::setErrorNotification('Invalid User');
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
            DB::transaction(function () use($request, $user, &$uploadedPath) {
                $data = [];
                $unique_code = Auth::id().'-'.time().'-'.uniqid();
                if($request->hasFile('files'))
                {
                    $folder = '/assets/uploads/documents/user';
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
                    $docUsers = [];
                    foreach($docs as $doc) {
                        $docUsers[] = [
                            'user_id' => $user->id,
                            'document_id' => $doc->id
                        ];
                    }

                    DocumentUser::insert($docUsers); // insert documents user
                }
            });
            NotificationHelper::setSuccessNotification('Upload success');
            return redirect()->route('document.user', ['userId' => $user->id]);
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

    public function edit($userId, $id)
    {
        
        $user = User::find($userId);
        if($user == null) {
            NotificationHelper::setErrorNotification('Invalid User');
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
                ['name' => 'Document User', 'route' => 'document.user', 'routeParam' => ['userId' => $user->id], 'class' => ''],
                ['name' => 'Edit Document', 'route' => 'document.user.update', 'routeParam' => ['userId' => $user->id, 'id' => $id], 'class' => 'active']
            ],
            'userId' => $user->id,
            'row' => $doc
        ];
        return view('admin.document.user.edit')->with($data);
    }

    public function update(Request $request, $userId, $id) 
    {
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        
        $user = User::find($userId);
        if($user == null) {
            NotificationHelper::setErrorNotification('Invalid User');
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
        return redirect()->route('document.user', ['userId' => $user->id]);
    }

    
    // Ajax with datatable
    public function dataTable(Request $request, $userId)
    {
       

        $user = User::find($userId);
        if($user == null) {
            NotificationHelper::setErrorNotification('Invalid User');
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
        //  $totalRecords = User::where('role', $role)->where('status', 'active')->count();

        //  Total number of record with filtering
        $totalRecordwithFilter = Document::join('document_users', 'document_users.document_id', '=', 'documents.id')
                                    ->whereRaw('1=1'.$searchQuery)
                                    ->where('document_users.user_id', $user->id)
                                    ->count();
        
        ## Fetch records
        $records = Document::join('document_users', 'document_users.document_id', '=', 'documents.id')
                    ->whereRaw('1=1'.$searchQuery)
                    ->where('document_users.user_id', $user->id)
                    ->select('documents.*')
                    ->orderBy('documents.'.$columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            $extension = FileHelper::getFileIcon($record->extension);
            $routeEdit = route('document.user.update', ['userId' => $user->id, 'id' => $record->id]);
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
