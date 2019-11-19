<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use Auth;
use App\RevenueCost;
use App\RevenueCostCategory;
use NotificationHelper;


class RevenueCostController extends Controller
{
    private $type = ['revenue', 'cost'];
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function index()
    {
        $data = [
            'title' => 'List Revenue Cost',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Revenue Cost', 'route' => 'revenue-cost', 'class' => 'active']
            ],
        ];
        return view('cms.revenue-cost.index')->with($data);
    }

    private function create($type)
    {
        if(!in_array($type, $this->type)) {
            NotificationHelper::setWarningNotification('Invalid Type');
            return redirect()->back();
        }

        $categories = RevenueCostCategory::where('type', $type)->get();
        $data = [
            'title' => 'Create '.ucfirst($type),
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Revenue Cost', 'route' => 'revenue-cost', 'class' => ''],
                ['name' => 'Create', 'route' => '', 'class' => 'active']
            ],
            'categories' => $categories,
            'type' => $type
        ];
        return view('cms.revenue-cost.create')->with($data);
    }

    public function createRevenue() {
        return $this->create('revenue');
    }

    public function createCost() {
        return $this->create('cost');
    }

    public function store(Request $request, $type)
    {
        $request->validate([
            'category' => 'required',
            'date' => 'required',
            'price' => 'required|min:0',
        ]);

        if(!in_array($type, $this->type)) {
            NotificationHelper::setWarningNotification('Invalid Type');
            return redirect()->back();
        }

        try 
        {     
            RevenueCost::create([
                'company_id' => Auth::user()->company_id,
                'category_id' => $request->category,
                'date' => $request->date,
                'price' => $request->price,
                'note' => $request->note,
                'type' => $type,
                'reference_table' => 'default_code',
                'created_by' => Auth::id()
            ]);

            NotificationHelper::setSuccessNotification('Created '.ucfirst($type).' success');
            return redirect()->route('revenue-cost');
           
        } 
        catch (\Exception $e) 
        {
            dd($e);
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function edit(int $id)
    {
        $row = RevenueCost::find($id);
        if($row == null) {
            NotificationHelper::setWarningNotification('Invalid Id');
            return redirect()->back();
        }

        $categories = RevenueCostCategory::where('type', $row->type)->get();
        $data = [
        
            'title' => 'Edit '.ucfirst($row->type),
            'row' => $row,
            'categories' => $categories,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Revenue Cost', 'route' => 'revenue-cost', 'class' => ''],
                ['name' => 'Edit', 'route' => '', 'class' => 'active']
            ],
        ];
        return view('cms.revenue-cost.edit')->with($data);
        
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'category' => 'required',
            'date' => 'required',
            'price' => 'required|min:0',
        ]);

        $revenueCode = RevenueCost::find($id);
        if($revenueCode == null) {
            NotificationHelper::setWarningNotification('Invalid Id');
            return redirect()->back();
        }

        try 
        {
           
            $revenueCode->category_id = $request->category;
            $revenueCode->date = $request->date;
            $revenueCode->price = $request->price;
            $revenueCode->note = $request->note;
            $revenueCode->save();
            
            NotificationHelper::setSuccessNotification('Updated Revenue Cost success');
            return redirect()->route('revenue-cost');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
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

        //  Total number of record with filtering
        $totalRecordwithFilter = RevenueCost::whereRaw('1=1'.$searchQuery)->count();
        
        ## Fetch records
        $records = RevenueCost::whereRaw('1=1'.$searchQuery)
                    // ->orderBy($columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            $routeEdit = route('revenue-cost.update', ['id' => $record->id]);
            // $routeDetail = route('revenue-cost-detail', ['revenueId' => $record->id]);
            // $routeDelete = route('revenue-cost.delete', ['id' => $record->id]);
            $data[] = [
                "category_id" => $record->category_id,
                "type" => $record->type,
                "date" => $record->date,
                "price" => $record->price,
                "note" => $record->note,
                "action" => "<div class='btn-group'>
                                <a href='$routeEdit' class='btn btn-default btn-sm'><i class='far fa-edit'></i></a>
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
