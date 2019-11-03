<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use Auth;
use App\Todo;
use NotificationHelper;

class TodoController extends Controller
{   
    private $status = ['active', 'inactive'];

    public function index(Request $request)
    {
        $f_search = isset($request->search) ? $request->search : "";
        $todos = Todo::where('name', 'like', '%'.$f_search.'%')
                    ->paginate(10);

        $data = [
            'title' => 'List Todo',
            'data' => $todos,
            'f_search' => $f_search
        ];
        return view('cms.todo.index')->with($data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create New Todo',
            'status' => $this->status,
        ];
        return view('cms.todo.create')->with($data);
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|max:255|unique:todos',
            'status' => [
                'required',
                Rule::in($this->status),
            ],
        ]);

        try 
        {     
            // Save Todo
            Todo::create([
                'name' => $request->name,
                'description' => $request->description,
                'status' => $request->status,
                'created_by' => Auth::id()
            ]);

            NotificationHelper::setSuccessNotification('created_success');
            return back();

           
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function edit($id)
    {
        $row = Todo::findOrFail($id);
        $data = [
            'title' => 'Edit Todo',
            'status' => $this->status,
            'row'  => $row,
        ];
        
        return view('cms.todo.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>  [
                'required',
                'max:255',
                Rule::unique('todos')->ignore($id),
            ],
            'status' => [
                'required',
                Rule::in($this->status),
            ],
        ]);

        try 
        {

            $todo = Todo::findOrFail($id);

            $todo->name = $request->name;
            $todo->status = $request->status;
            $todo->description = $request->description;
            $todo->updated_by = Auth::id();
            $todo->save();

            NotificationHelper::setSuccessNotification('updated_success');
            return redirect()->route('todo');

           
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function destroy($id)
    {
        $todo = Todo::findOrFail($id);
        try 
        {
            $todo->deleted_at = date("Y-m-d H:i:s");
            $todo->deleted_by = Auth::id();
            $todo->save();

            NotificationHelper::setDeletedPopUp('deleted_success');
            return redirect()->route('todo');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return redirect()->route('todo');
        }
    }
    
}
