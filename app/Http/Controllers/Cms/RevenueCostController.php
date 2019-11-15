<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use Auth;
use App\RevenueCost;
use NotificationHelper;


class RevenueCostController extends Controller
{
   
    private $type = ['revenue', 'cost'];
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = [
            'title' => 'List Revenue Cost',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Revenue Cost', 'route' => 'revenue-cost', 'class' => 'active']
            ],
        ];
        return view('cms.revenueCost.index')->with($data);
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
        
            'title' => 'List Revenue Cost',
            'type'=>$this->type,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Revenue Cost', 'route' => 'revenue-cost', 'class' => 'active']
            ],
        ];
        return view('cms.revenueCost.create')->with($data);
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
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:255',
        ]);

        try 
        {     
        
            // Save Todo
            RevenueCost::create([
                'company_id' => Auth::user()->company_id,
                'name' => $request->name,
                'code' => $request->code,
                'type' => $request->type,
                'created_by' => Auth::id()
            ]);

            NotificationHelper::setSuccessNotification('Created Revenue Cost success');

            return redirect()->route('revenue-cost');

           
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RevenueCost  $revenueCost
     * @return \Illuminate\Http\Response
     */
    public function show(RevenueCost $revenueCost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RevenueCost  $revenueCost
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
        $row = RevenueCost::findOrFail($id);
        $data = [
        
            'title' => 'Edit Revenue Cost',
            'type'=>$this->type,
            'row'=>$row,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Edit Revenue Cost', 'route' => 'revenue-cost', 'class' => 'active']
            ],
        ];
        return view('cms.revenueCost.edit')->with($data);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RevenueCost  $revenueCost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
        $request->validate([
            'name' => [
            'required',
            'max:255',
                Rule::unique('revenue_cost_categories')->ignore($id),
            ],
            'code' =>'required|max:255',
            
        ]);

        try 
        {
           
            $revenueCode= RevenueCost::findOrFail($id);
            $revenueCode->company_id = Auth::user()->company_id;
            $revenueCode->name=$request->name;
            $revenueCode->code=$request->code;
            $revenueCode->type=$request->type;
            $revenueCode->created_by = Auth::id();
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RevenueCost  $revenueCost
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        //
        $revenue = RevenueCost::findOrFail($id);
        try 
        {
            $revenue->deleted_at = date("Y-m-d H:i:s");
            $revenue->deleted_by = Auth::id();
            $revenue->save();
            NotificationHelper::setDeletedPopUp('Deleted  Revenue Cost success');
            return redirect()->route('revenue-cost');
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return redirect()->route('revenue-cost');
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
        $totalRecords = RevenueCost::count();

        //  Total number of record with filtering
        $totalRecordwithFilter = RevenueCost::whereRaw('1=1'.$searchQuery)->count();
        
        ## Fetch records
        $records = RevenueCost::whereRaw('1=1'.$searchQuery)
                    ->orderBy($columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            $routeEdit = route('revenue-cost.update', ['id' => $record->id]);
            $routeDelete = route('revenue-cost.delete', ['id' => $record->id]);
            $data[] = [
                "name" => $record->name,
                "code" => $record->code,
                "type" => $record->type,
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
