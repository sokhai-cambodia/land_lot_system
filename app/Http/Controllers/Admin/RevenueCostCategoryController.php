<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use App\RevenueCostCategory;

use NotificationHelper;
use Auth;

class RevenueCostCategoryController extends Controller
{
    private $type = ['revenue', 'cost'];
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];
   
    public function index()
    {
        
        $data = [
            'title' => 'List Revenue Cost Category',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Revenue Cost Detail', 'route' => 'revenue-cost', 'class' => 'active']
            ],
        ];
        return view('admin.revenue-cost-category.index')->with($data);

    }

    
    public function create()
    {
        $data = [
            'title' => 'Create Revenue Cost Category',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Revenue Cost Category', 'route' => 'revenue-cost.category', 'class' => ''],
                ['name' => 'Create', 'route' => '', 'class' => 'active']
            ],
            'type' => $this->type
        ];
        return view('admin.revenue-cost-category.create')->with($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' =>  [
                'required',
                'max:255',
                Rule::unique('revenue_cost_categories'),
            ],
            'code' =>  [
                'max:255',
                Rule::unique('revenue_cost_categories'),
            ],
            'type' => [
                'required',
                Rule::in($this->type),
            ],
        ]);

        RevenueCostCategory::create([
            'company_id' => Auth::user()->company_id,
            'name' => $request->name,
            'code' => $request->code,
            'type' => $request->type,
            'created_by' => Auth::id()
        ]);

        NotificationHelper::setSuccessNotification('Created Revenue Cost Category success');

        return redirect()->route('revenue-cost.category');

    }
    
    public function edit($id)
    {
        $category = RevenueCostCategory::find($id);
        if($category == null) {
            NotificationHelper::setWarningNotification('Invalid Category');
            return redirect()->route('revenue-cost.category');
        }

        if(!$category->is_editable) {
            NotificationHelper::setWarningNotification('Cannot edit default category');
            return redirect()->route('revenue-cost.category');
        }

        $data = [
            'title' => 'Edit Revenue Cost Category',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Revenue Cost Category', 'route' => 'revenue-cost.category', 'class' => ''],
                ['name' => 'Edit', 'route' => '', 'class' => 'active']
            ],
            'row' => $category
        ];
        return view('admin.revenue-cost-category.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' =>  [
                'required',
                'max:255',
                Rule::unique('revenue_cost_categories')->ignore($id),
            ],
            'code' =>  [
                'max:255',
                Rule::unique('revenue_cost_categories')->ignore($id),
            ],
        ]);

        $category = RevenueCostCategory::find($id);
        if($category == null) {
            NotificationHelper::setWarningNotification('Invalid Category');
            return redirect()->route('revenue-cost.category');
        }

        if(!$category->is_editable) {
            NotificationHelper::setWarningNotification('Cannot edit default category');
            return redirect()->route('revenue-cost.category');
        }

        $category->name = $request->name;
        $category->code = $request->code;
        $category->updated_by = Auth::id();
        $category->save();
        
        NotificationHelper::setSuccessNotification('Update Revenue Cost Category success');

        return redirect()->route('revenue-cost.category');

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
            $searchQuery = " and (name LIKE '%$searchValue%') ";
        }
     

        //  Total number of record with filtering
        $totalRecordwithFilter = RevenueCostCategory::whereRaw('1=1'.$searchQuery)->count();
        
        ## Fetch records
        $records = RevenueCostCategory::whereRaw('1=1'.$searchQuery)
                    // ->orderBy($columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = [];
        foreach($records as $record) {
            $actions = "";
            if($record->is_editable) {
                $routeEdit = route('revenue-cost.category.update', ['id' => $record->id]);
                $actions .= "<a href='$routeEdit' class='btn btn-default btn-sm' title='Edit'><i class='far fa-edit'></i></a>";
            }
            
            $data[] = [
                "name" => $record->name,
                "code" => $record->code,
                "type" => $record->type,
                "action" => "<div class='btn-group'>
                                $actions   
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
