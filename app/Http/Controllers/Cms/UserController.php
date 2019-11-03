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
    private $icon = 'icon-layers';
    private $gender = ['male', 'female'];
    private $status = ['active', 'inactive'];


    public function index(Request $request)
    {

        $f_role = isset($request->role) ? $request->role : 0;
        $f_search = isset($request->search) ? $request->search : "";

        $where = [];
        if($f_role > 0 && $f_role != '') {
            $where[] = ['role_id', $f_role];
        }


        $users = User::where($where)
                    ->where(function($query) use($f_search) {
                        $query->orWhere('username', 'like', '%'.$f_search.'%')
                        ->orWhere('phone', 'like', '%'.$f_search.'%')
                        ->orWhere(DB::raw("CONCAT(last_name, last_name)"), 'like', '%'.$f_search.'%');
                    })
                    ->paginate(10);
        $roles = Role::all();
        $data = [
            'title' => 'List User',
            'icon' => $this->icon,
            'data' => $users,
            'roles' => $roles,
            'f_role' => $f_role,
            'f_search' => $f_search
        ];
        return view('cms.user.index')->with($data);
    }

    public function create()
    {
        $roles = Role::all();   
        $data = [
            'title' => 'Create New User',
            'icon' => $this->icon,
            'gender' => $this->gender,
            'status' => $this->status,
            'roles'  => $roles
        ];
        return view('cms.user.create')->with($data);
    }

    public function store(Request $request)
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
            'username' => 'required|unique:users|max:255',
            'role_id' => 'required',
        ]);

        try 
        {     
            DB::transaction(function () use($request) {

                $role = Role::find($request->role_id);
                if($role ==  null) {
                    NotificationHelper::setErrorNotification('invalid_role');
                    return back();
                }

                $image = null;
                if($request->hasFile('image')) {
                    $image = FileHelper::upload($request->image);
                }
                
                User::create([
                    'last_name' => $request->last_name,
                    'first_name' => $request->first_name,
                    'dob' => $request->dob,
                    'gender' => $request->gender,
                    'status' => $request->status,
                    'image' => $image,
                    'username' => $request->username,
                    'phone' => $request->phone,
                    'password' => Hash::make('123456'), // default password
                    'role_id' => $request->role_id,
                    'created_by' => Auth::id(),
                ]);
                
            });

            NotificationHelper::setSuccessNotification('created_success');
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
    
}
