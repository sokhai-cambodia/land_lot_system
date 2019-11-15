<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use Auth;
use App\Land;
use NotificationHelper;

class LandController extends Controller
{
    private $status = ['booked', 'sold', 'on_sale'];
    private $type = ['land', 'land_lot'];
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];
    private $location=['Phnom Penh','Prey Veng','Banteay Meanchey','Battambang','Kampong Cham','Kampong Chhnang'];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'title' => 'List Lands',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Land', 'route' => 'land', 'class' => 'active']
            ],
        ];
        return view('cms.land.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [
            'title' => 'Create Land',
            'status' => $this->status,
            'type'=>$this->type,
            'location'=>$this->location,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Land', 'route' => 'land', 'class' => 'active']
            ],
        ];
        return view('cms.land.create')->with($data);
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
     * @param  \App\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function show(Land $land)
    {
        //
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function edit(Land $land)
    {
        //
        $row = Land::findOrFail($land);
        $data = [
            'title' => 'Edit Land',
            'status' => $this->status,
            'row'  => $row,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Todo', 'route' => 'todo', 'class' => ''],
                ['name' => 'Edit Land', 'route' => 'land.edit', 'class' => 'active']
            ],
        ];
        
        return view('cms.land.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Land $land)
    {
        //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Land  $land
     * @return \Illuminate\Http\Response
     */
    public function destroy(Land $land)
    {
        //
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
             $searchQuery = " and (title like "."'%$searchValue%'".") ";
         }
 
         //  Total number of records without filtering
         $totalRecords = Land::count();
 
         //  Total number of record with filtering
         $totalRecordwithFilter = Land::whereRaw('1=1'.$searchQuery)->count();
         
         ## Fetch records
         $records = Land::whereRaw('1=1'.$searchQuery)
                     ->orderBy($columnName, $columnSortOrder)
                     ->offset($row)
                     ->limit($rowPerPage)
                     ->get();
 
         $data = array();
 
         foreach($records as $record) {
             $routeEdit = route('land.update', ['id' => $record->id]);
             $routeDelete = route('land.delete', ['id' => $record->id]);
             $data[] = [
                 "title" => $record->title,
                 "description" => $record->description,
                 "size"=>$record->size,
                 "width"=>$record->width,
                 "height"=>$record->width,
                 "qty"=>$record->width,
                 "price"=>$record->price,
                 "commission"=>$record->commission,
                 "location"=>$record->location,
                 "type" => $record->type,
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
     //List Testing Respone

     public function list(){
         $data=Land::all();
         return $data;
     }
}
