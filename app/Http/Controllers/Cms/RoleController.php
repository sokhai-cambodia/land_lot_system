<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Freshbitsweb\Laratables\Laratables;
use App\Role;
use Auth;
use NotificationHelper;


class RoleController extends Controller
{
    private $icon = 'icon-home';
    
    public function index()
    {
        $data = [
            'title' => 'List Role',
            'icon' => $this->icon
        ];
        return view('cms.role.index')->with($data);
    }

    public function getRoleLists()
    {
        return Laratables::recordsOf(Role::class);
    }

    public function create()
    {
        $data = [
            'title' => 'Create New Role',
            'icon' => $this->icon
        ];
        return view('cms.role.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles|max:255',
        ]);

        try 
        {
            Role::create([
                'name' => $request->name,
                'description' => $request->description,
                'created_by' => Auth::id(),
            ]);
            NotificationHelper::setSuccessNotification('Created Success...!', true);
            return back();
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function show(Role $role)
    {
        //
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Role',
            'icon' => $this->icon
        ];
        $data['role'] = Role::findOrFail($id);
        return view('cms.role.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>  [
                'required',
                'max:255',
                Rule::unique('roles')->ignore($id),
            ],
        ]);

        try 
        {
            $role = Role::findOrFail($id);
            $role->name = $request->name;
            $role->description = $request->description;
            $role->updated_by = Auth::id();
            $role->save();

            NotificationHelper::setSuccessNotification('updated_success');
            return redirect()->route('role');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        try 
        {
            $role->deleted_at = date("Y-m-d H:i:s");
            $role->deleted_by = Auth::id();
            $role->save();

            NotificationHelper::setDeletedPopUp('deleted_success');
            return redirect()->route('role');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return redirect()->route('role');
        }
    }
}
