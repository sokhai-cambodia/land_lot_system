<?php

namespace App\Http\Controllers\Cms;

use App\Document;
use App\DocumentUser;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;
use Auth;
use App\User;
use NotificationHelper;
use FileHelper;


class UserController extends Controller
{   
    private $gender = ['male', 'female'];
    private $status = ['active', 'inactive'];
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];
    private $roles = ['customer', 'witness', 'staff'];

    private function userList($role)
    {
        if(!in_array($role, $this->roles)) {
            NotificationHelper::setWarningNotification('Invalid Role');
            return redirect()->back();
        }

        $data = [
            'title' => 'List '.ucfirst($role),
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => ucfirst($role), 'route' => 'user.'.$role, 'class' => 'active']
            ],
            'role' => $role
            
        ];
        return view('cms.user.index')->with($data);
    }

    public function deletedList()
    {

        $data = [
            'title' => 'List Deleted user',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Delete User', 'route' => 'user.deleted', 'class' => 'active']
            ],
            
        ];
        return view('cms.user.deleted')->with($data);
    }

    public function customer()
    {
        return $this->userList('customer');
    }

    public function witness()
    {
        
        return $this->userList('witness');
    }

    public function staff()
    {
        
        return $this->userList('staff');
    }

    public function create($role)
    {

        if(!in_array($role, $this->roles)) {
            NotificationHelper::setWarningNotification('Invalid Role');
            return redirect()->back();
        }
        
        $data = [
            'title' => 'Create New '.ucfirst($role),
            'gender' => $this->gender,
            'status' => $this->status,
            'role' => $role
        ];
        return view('cms.user.create')->with($data);
    }

    public function store(Request $request, $role)
    {
        if(!in_array($role, $this->roles)) {
            NotificationHelper::setWarningNotification('Invalid Role');
            return redirect()->back();
        }
        
        $request->validate([
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'gender' => [
                'required',
                Rule::in($this->gender),
            ],
            'status' => [
                'required',
                Rule::in($this->status),
            ],
            'dob' => 'required|date',
            'username' =>  [
                'max:255',
                Rule::unique('users'),
            ],
        ]);

        try 
        {     
            DB::transaction(function () use($request, $role) {

                $image = null;
                if($request->hasFile('image')) {
                    $image = FileHelper::upload($request->image);
                }
                
                User::create([
                    'company_id' => Auth::user()->company_id,
                    'last_name' => $request->last_name,
                    'first_name' => $request->first_name,
                    'phone' => $request->phone,
                    'national_id' => $request->national_id,
                    'passport_id' => $request->passport_id,
                    'image' => $image,
                    'username' => $request->username,
                    'password' => Hash::make($request->password),
                    'status' => $request->status,
                    'gender' => $request->gender,
                    'role' => $role,
                    'dob' => $request->dob,
                    'created_by' => Auth::id()
                ]);
                
            });

            NotificationHelper::setSuccessNotification('Created '.ucfirst($role).' Success');
            return back();
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function show(User $user)
    {
        //
    }

    public function edit($role, $id)
    {
        if(!in_array($role, $this->roles)) {
            NotificationHelper::setWarningNotification('Invalid Role');
            return redirect()->back();
        }
        
        $user = User::findOrFail($id);
        
        if($user->status != 'active') {
            NotificationHelper::setWarningNotification('Can only update active user');
            return redirect()->back();
        }

        $data = [
            'title' => 'Edit '.ucfirst($role),
            'gender' => $this->gender,
            'status' => $this->status,
            'row'  => $user,
            'role' => $role
        ];
        
        return view('cms.user.edit')->with($data);
    }

    public function update(Request $request,$role, $id)
    {
        if(!in_array($role, $this->roles)) {
            NotificationHelper::setWarningNotification('Invalid Role');
            return redirect()->back();
        }

        $request->validate([
            'last_name' => 'required|max:255',
            'first_name' => 'required|max:255',
            'gender' => [
                'required',
                Rule::in($this->gender),
            ],
            // 'status' => [
            //     'required',
            //     Rule::in($this->status),
            // ],
            'dob' => 'required|date',
        ]);

        try 
        {
            DB::transaction(function () use($request, $id, $role) {
                $user = User::findOrFail($id);
                
                if($user->status != 'active') {
                    NotificationHelper::setWarningNotification('Can only update active user');
                    return redirect()->back();
                }

                if($request->hasFile('image')) {
                    $user->image = FileHelper::updateImage($request->image, $user->image, '');
                }
            
                $user->last_name = $request->last_name;
                $user->first_name = $request->first_name;
                $user->phone = $request->phone;
                $user->national_id = $request->national_id;
                $user->passport_id = $request->passport_id;
                // $user->status = $request->status;
                $user->gender = $request->gender;
                $user->role = $role;
                $user->dob = $request->dob;
                $user->updated_by = Auth::id();
                $user->save();
            });

            NotificationHelper::setSuccessNotification('Updated '.ucfirst($role).' Success');
            return redirect()->route('user.'.$role);
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function toggle($role, $id)
    {
        
        if(!in_array($role, $this->roles)) {
            NotificationHelper::setWarningNotification('Invalid Role');
            return redirect()->back();
        }

        $user = User::findOrFail($id);
        $status = $user->status;
        try 
        {
            $user->status = $status == 'active' ? 'inactive' : 'active';
            $user->updated_by = Auth::id();
            $user->save();

            NotificationHelper::setSuccessNotification('Updated success');
            return redirect()->route('user.'.$role);
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return redirect()->route('user.'.$role);
        }
    }

    // Ajax with datatable
    public function dataTable(Request $request)
    {
       
        $role = $request->role;
        if(!in_array($role, $this->roles)) {
            return response()->json([
                'status' => 0,
                'msg' => 'invalid role'
            ]);
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
            $searchQuery = " and (CONCAT(last_name, '', first_name) like "."'%$searchValue%'".") ";
        }

        //  Total number of records without filtering
        //  $totalRecords = User::where('role', $role)->where('status', 'active')->count();

        //  Total number of record with filtering
        $totalRecordwithFilter = User::whereRaw('1=1'.$searchQuery)
                                    ->where('role', $role)
                                    ->where('status', 'active')
                                    ->count();
        
        ## Fetch records
        $records = User::selectRaw("*, CONCAT(last_name, '', first_name) AS name ")
                    ->whereRaw('1=1'.$searchQuery)
                    ->where('role', $role)
                    ->where('status', 'active')
                    ->orderBy($columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            $routeEdit = route('user.update', ['role' => $role, 'id' => $record->id]);
            $routeToggle = route('user.toggle', ['role' => $role, 'id' => $record->id]);
            $routeDocument = route('document.user', ['userId' => $record->id]);
            $data[] = [
                "name" => $record->last_name.' '.$record->first_name,
                "phone" => $record->phone,
                "national_id" => $record->national_id,
                "passport_id" => $record->passport_id,
                "status" => $record->status,
                "action" => "<div class='btn-group'>
                                <a href='$routeEdit' class='btn btn-default btn-sm' title='Edit'><i class='far fa-edit'></i></a>
                                <button type='button' data-url='$routeToggle' class='btn btn-default btn-sm btn-delete' title='Inactive'><i class='fas fa-toggle-on'></i></button>
                                <button type='button' data-id='$record->id' class='btn btn-default btn-sm btn-view-detail' title='Detail'><i class='fas fa-eye'></i></button>
                                <a href='$routeDocument' class='btn btn-default btn-sm' title='Documents'><i class='far fa-folder'></i></a>
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

    public function deletedListDataTable(Request $request)
    {
        
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
            $searchQuery = " and (CONCAT(last_name, '', first_name) like "."'%$searchValue%'".") ";
        }

        //  Total number of records without filtering
        $totalRecords = User::count();

        //  Total number of record with filtering
        $totalRecordwithFilter = User::whereRaw('1=1'.$searchQuery)
                                    ->where('status', 'inactive')
                                    ->count();
        
        ## Fetch records
        $records = User::selectRaw("*, CONCAT(last_name, '', first_name) AS name ")
                    ->whereRaw('1=1'.$searchQuery)
                    ->where('status', 'inactive')
                    ->orderBy($columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();
        
        foreach($records as $record) {
            $routeToggle = route('user.toggle', ['role' => $record->role, 'id' => $record->id]);
            $data[] = [
                "name" => $record->last_name.' '.$record->first_name,
                "role" => $record->role,
                "phone" => $record->phone,
                "national_id" => $record->national_id,
                "passport_id" => $record->passport_id,
                "status" => $record->status,
                "action" => "<div class='btn-group'>
                                <button type='button' data-url='$routeToggle' class='btn btn-default btn-sm btn-delete'><i class='fas fa-toggle-off'></i></button>
                            </div>",
            ];
        }

        ## Response
        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecordwithFilter,
            "iTotalDisplayRecords" => $totalRecords,
            "aaData" => $data
        ];
        
        return response()->json($response);

    }

    // view user detail with modal
    public function detail(Request $request) 
    {
        $user = User::find($request->id);
        if($user == null) {
            return response()->json([ 'status' => 0 ]);
        }

        $docUsers = DocumentUser::where('user_id', 39)
                                ->orderBy('document_id', 'desc')
                                ->limit(5)
                                ->pluck('document_id');
        $docs = Document::whereIn('id', $docUsers)->get();
        
        

        $modal = view('cms.user.modal-detail')
                ->with([
                    'row' => $user,
                    'docs' => $docs
                ])
                ->render();

        return response()->json([
            'status' => 1,
            'modal' => $modal,
            'docUsers' => $docUsers
        ]);
    }
    
}
