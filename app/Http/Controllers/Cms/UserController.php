<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;
use Auth;
use App\User;
use App\Role;
use NotificationHelper;
use FileHelper;


class UserController extends Controller
{   
    private $gender = ['male', 'female'];
    private $status = ['active', 'inactive'];
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];
    private $roles = ['customer', 'witness', 'staff'];

    public function index()
    {

        $data = [
            'title' => 'List Customer',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Customer', 'route' => 'user.customer', 'class' => 'active']
            ],
            
        ];
        return view('cms.user.index')->with($data);
    }

    public function customer()
    {
        
        $data = [
            'title' => 'List Customer',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Customer', 'route' => 'user.customer', 'class' => 'active']
            ],
            'role' => 'customer'
        ];
        return view('cms.user.index')->with($data);
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
            'dob' => 'required|date'
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

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        $data = [
            'title' => 'Edit User',
            'icon' => $this->icon,
            'gender' => $this->gender,
            'status' => $this->status,
            'roles'  => $roles,
            'user'  => $user
        ];
        
        return view('cms.user.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
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
            'role_id' => 'required',
            'username' =>  [
                'required',
                'max:255',
                Rule::unique('users')->ignore($id),
            ],
        ]);

        try 
        {
            DB::transaction(function () use($request, $id) {
                $user = User::findOrFail($id);
                if($request->hasFile('image')) {
                    $user->image = FileHelper::updateImage($request->image, $user->image, '');
                }
                
              
                $user->last_name = $request->last_name;
                $user->first_name = $request->first_name;
                $user->dob = $request->dob;
                $user->phone = $request->phone;
                $user->gender = $request->gender;
                $user->status = $request->status;
                $user->username = $request->username;
                $user->role_id = $request->role_id;
                $user->updated_by = Auth::id();
                $user->save();
            });

            NotificationHelper::setSuccessNotification('updated_success');
            return redirect()->route('user');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try 
        {
            $user->deleted_at = date("Y-m-d H:i:s");
            $user->deleted_by = Auth::id();
            $user->save();

            NotificationHelper::setDeletedPopUp('deleted_success');
            return redirect()->route('user');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return redirect()->route('user');
        }
    }

    public function toggle($id)
    {
        $user = User::findOrFail($id);
        try 
        {
            $user->status = $user->status == 'active' ? 'inactive' : 'active';
            $user->updated_by = Auth::id();
            $user->save();

            NotificationHelper::setSuccessNotification('updated_success');
            return redirect()->route('user');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return redirect()->route('user');
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
        $totalRecords = User::count();

        //  Total number of record with filtering
        $totalRecordwithFilter = User::whereRaw('1=1'.$searchQuery)->where('role', $role)->count();
        
        ## Fetch records
        $records = User::selectRaw("*, CONCAT(last_name, '', first_name) AS name ")
                    ->whereRaw('1=1'.$searchQuery)
                    ->where('role', $role)
                    ->orderBy($columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            $routeEdit = route('todo.update', ['id' => $record->id]);
            $routeDelete = route('todo.delete', ['id' => $record->id]);
            $data[] = [
                "name" => $record->last_name.' '.$record->first_name,
                "phone" => $record->phone,
                "national_id" => $record->national_id,
                "passport_id" => $record->passport_id,
                "status" => $record->status,
                "action" => "<div class='btn-group'>
                                <a href='$routeEdit' class='btn btn-default btn-sm'><i class='far fa-edit'></i></a>
                                <button type='button' data-url='$routeDelete' class='btn btn-default btn-sm btn-delete'><i class='fas fa-trash-alt'></i></button>
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
    
}
