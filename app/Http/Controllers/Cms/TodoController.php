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
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function index()
    {

        $data = [
            'title' => 'List Todo',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Todo', 'route' => 'todo', 'class' => 'active']
            ],
        ];
        return view('cms.todo.index')->with($data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create Todo',
            'status' => $this->status,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Todo', 'route' => 'todo', 'class' => ''],
                ['name' => 'Create Todo', 'route' => 'todo.create', 'class' => 'active']
            ],
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
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Todo', 'route' => 'todo', 'class' => ''],
                ['name' => 'Edit Todo', 'route' => 'todo.edit', 'class' => 'active']
            ],
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

    // Ajax with datatable
    public function dataTable(Request $request)
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
            $searchQuery = " and (name like "."'%$searchValue%'".") ";
        }

        //  Total number of records without filtering
        $totalRecords = Todo::count();

        //  Total number of record with filtering
        $totalRecordwithFilter = Todo::whereRaw('1=1'.$searchQuery)->count();
        
        ## Fetch records
        $records = Todo::whereRaw('1=1'.$searchQuery)
                    ->orderBy($columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            $routeEdit = route('todo.update', ['id' => $record->id]);
            $routeDelete = route('todo.delete', ['id' => $record->id]);
            $data[] = [
                "name" => $record->name,
                "description" => $record->description,
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
