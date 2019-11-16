<?php
namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use App\RevenueCost;
use App\RevenueCostCategory;

use NotificationHelper;

class RevenueCostCategoryController extends Controller
{
    private $type = ['revenue', 'cost'];
    private $reference_table=['default_code', 'land_payment', 'installment_payment', 'legal_service_process'];
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($revenueId)
    {
       
        $revenue=RevenueCost::findOrFail($revenueId);
        //
        $data = [
            'title' => 'List Revenue Cost Detail',
            'revenue'=>$revenue,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Revenue Cost Detail', 'route' => 'revenue-cost', 'class' => 'active']
            ],
        ];
        return view('cms.revenueCostDetail.index')->with($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RevenueCostCategory  $revenueCostCategory
     * @return \Illuminate\Http\Response
     */
    public function show(RevenueCostCategory $revenueCostCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RevenueCostCategory  $revenueCostCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(RevenueCostCategory $revenueCostCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RevenueCostCategory  $revenueCostCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RevenueCostCategory $revenueCostCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RevenueCostCategory  $revenueCostCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(RevenueCostCategory $revenueCostCategory)
    {
        //
    }
     // Ajax with datatable
     public function dataTable(Request $request,$revenueId)
     {
         $revenue=RevenueCost::findOrFail($revenueId);

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
         $totalRecords = RevenueCostCategory::count();
 
         //  Total number of record with filtering
         $totalRecordwithFilter = RevenueCostCategory::whereRaw('1=1'.$searchQuery)
         ->where('category_id', $revenue->id)
         ->count();
         
         ## Fetch records
         $records = RevenueCostCategory::whereRaw('1=1'.$searchQuery)
                     ->where('category_id', $revenue->id)
                     ->orderBy($columnName, $columnSortOrder)
                     ->offset($row)
                     ->limit($rowPerPage)
                     ->get();
 
        
         foreach($records as $record) {
             $routeEdit = route('revenue-cost.update', ['id' => $record->id]);
             $routeDetail = route('revenue-cost-detail', ['id' => $record->id]);
             $routeDelete = route('revenue-cost.delete', ['id' => $record->id]);
             $data[] = [
                 "date" => $record->name,
                 "price" => $record->code,
                 "note" => $record->type,
                 "reference_table"=>$record->reference_table,
                 "action" => "<div class='btn-group'>
                                 <a href='$routeEdit' class='btn btn-default btn-sm'><i class='far fa-edit'></i></a>
                                 <button type='button' data-url='$routeDelete' class='btn btn-default btn-sm btn-delete'><i class='fas fa-trash-alt'></i></button>
                                 <a href='$routeDetail' class='btn btn-default btn-sm'><i class='far fa-eye'></i></a>
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
     public function list(){
         $data=RevenueCostCategory::all();
         dd($data);
         return $data;
     }
}
