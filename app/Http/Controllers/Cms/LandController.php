<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

use Auth;
use App\Land;
use NotificationHelper;
use FileHelper;
use DB;

class LandController extends Controller
{

    private $status = ['booked', 'sold', 'on_sale'];
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];
   
    // land list
    public function index(Request $request)
    {
        // TODO: query by condition
        $f_landType = isset($request->landType) ? $request->landType : "";
        $whereData = [];
        if($f_landType != "") {
            $whereData[] = ['is_split_land_lot', $f_landType];
        }
        // query lands
        $lands = Land::where('type', 'land')
                        ->where($whereData)
                        ->orderBy('id', 'desc')
                        ->paginate(12);
        $landTypes = [
            ["key" => 0, "value" => "land"],
            ["key" => 1, "value" => "land has land lot"],
        ];
        $data = [
            'title' => 'List Lands',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Land', 'route' => 'land', 'class' => 'active']
            ],
            'status' => $this->status,
            'lands' => $lands,
            "landType" => $landTypes,
            'filter' => [
                'landType' => $f_landType
            ]
        ];
        return view('cms.land.index')->with($data);
    }

    // Create Land
    public function create()
    {
        $data = [
            'title' => 'Create Land',
            'status' => $this->status,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Land', 'route' => 'land', 'class' => 'active']
            ],
        ];
        return view('cms.land.create')->with($data);
    }

    // Save Land
    public function store(Request $request)
    {
       
        //
        $request->validate([
            'title' => 'required|max:255|unique:lands',
            'size' =>'required|min:0',
            'width' => 'required|min:0',
            'height' => 'required|min:0',
            'price' => 'required|min:0',
            'commission' => 'required|min:0|max:100',
            'status' => [
                'required',
                Rule::in($this->status),
            ],
        ]);

        try 
        {     
            $image = null;
            if($request->hasFile('image')) {
                $image = FileHelper::upload($request->image);
            }
            // Save Land
            Land::create([
                'company_id' => Auth::user()->company_id,
                'title' => $request->title,
                'description' => $request->description,
                'size' => $request->size,
                'width' => $request->width,
                'height' => $request->height,
                'qty' => 0,
                'price' => $request->price,
                'commission' => $request->commission,
                'location' => $request->location,
                'type' => 'land',
                'is_split_land_lot'=> 0,
                'image' => $image,
                'status' => $request->status,
                'created_by' => Auth::id()
            ]);
                
            NotificationHelper::setSuccessNotification('Created Land success');
            return redirect()->route('land');

        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }

    }

    // Edit land
    public function edit(int $land)
    {
        $row = Land::findOrFail($land);
        $data = [
            'title' => 'Edit Land',
            'status' => $this->status,
            'row'  => $row,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Land', 'route' => 'land', 'class' => ''],
                ['name' => 'Edit Land', 'route' => 'land.edit', 'class' => 'active']
            ],
        ];
        
        return view('cms.land.edit')->with($data);
    }

    // Update Land
    public function update(Request $request, int $id)
    {
        //
        $request->validate([
            'title' => [
                'required',
                'max:255',
                Rule::unique('lands')->ignore($id),
            ],
            'size' =>'required|min:0',
            'width' => 'required|min:0',
            'height' => 'required|min:0',
            'price' => 'required|min:0',
            'commission' => 'required|min:0|max:100',
            'status' => [
                'required',
                Rule::in($this->status),
            ],
        ]);

        try 
        {
            $land = Land::findOrFail($id);
            if($request->hasFile('image')) {
                $land->image = FileHelper::updateImage($request->image, $land->image, '');
            }

            $land->title = $request->title;
            $land->description = $request->description;
            $land->size = $request->size;
            $land->width = $request->width;
            $land->height = $request->height;
            $land->price = $request->price;
            $land->commission = $request->commission;
            $land->location = $request->location;
            $land->status = $request->status;
            $land->updated_by = Auth::id();
            $land->save();
            NotificationHelper::setSuccessNotification('Updated Land success');
            return redirect()->route('land');

           
        } 
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }

    }

    
    // Create Land Lot
    public function createLandLot()
    {
        $data = [
            'title' => 'Create Land Lot',
            'status' => $this->status,
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Land', 'route' => 'land', 'class' => 'active']
            ],
        ];
        return view('cms.land.create-land-lot')->with($data);
    }

    // Save Land Lot
    public function storeLandLot(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255|unique:lands', // for create land tab
            'size' =>'required|min:0',
            'width' => 'required|min:0',
            'height' => 'required|min:0',
            'status' => [
                'required',
                Rule::in($this->status),
            ],
            'g_size' =>'required|min:0', // for generate tab
            'g_width' => 'required|min:0',
            'g_height' => 'required|min:0',
            'g_price' => 'required|min:0',
            'g_commission' => 'required|min:0|max:100',
            'qty' => 'required|min:0',
            'll_titles' =>'required', // for create land lot tab
            'll_sizes' =>'required|min:0',
            'll_widths' => 'required|min:0',
            'll_heights' => 'required|min:0',
            'll_prices' => 'required|min:0',
            'll_commissions' => 'required|min:0',
        ]);
        
        try 
        {
            DB::transaction(function () use($request) {
                // Create Parent Land First
                $image = null;
                if($request->hasFile('image')) {
                    $image = FileHelper::upload($request->image);
                }

                $land = Land::create([
                    'company_id' => Auth::user()->company_id,
                    'title' => $request->title,
                    'description' => $request->description,
                    'size' => $request->size,
                    'width' => $request->width,
                    'height' => $request->height,
                    'qty' => $request->qty,
                    'price' => 0,
                    'commission' => 0,
                    'location' => $request->location,
                    'type' => 'land',
                    'is_split_land_lot'=> 1,
                    'image' => $image,
                    'status' => $request->status,
                    'created_by' => Auth::id()
                ]);
                
                // Create Land Lot
                $landLots = [];
                for($i = 0; $i < count($request->ll_titles); $i++) {
                    $landLots[] = [
                        'company_id' => Auth::user()->company_id,
                        'title' => $request->ll_titles[$i],
                        'description' => $request->description,
                        'size' => $request->ll_sizes[$i],
                        'width' => $request->ll_widths[$i],
                        'height' => $request->ll_heights[$i],
                        'qty' => 0,
                        'price' => $request->ll_prices[$i],
                        'commission' => $request->ll_commissions[$i],
                        'location' => $request->location,
                        'type' => 'land_lot',
                        'is_split_land_lot'=> 0,
                        'image' => $image,
                        'status' => $request->status,
                        'land_id' => $land->id,
                        'created_by' => Auth::id()
                    ];
                }

                Land::insert($landLots);
            });
            NotificationHelper::setSuccessNotification('Created Land Lot success');
            return redirect()->route('land.lot.create');
        }
        catch (\Exception $e) 
        {
            // NotificationHelper::errorNotification($e);
            dd();
            NotificationHelper::setErrorNotification('Error: '.$e->getMessage());
            return back()->withInput();
        }
    }
    
    //Land lot List
    public function landLot($id)
    {
        // TODO: query by condition
        // query land lots
        $lands = Land::where('type', 'land_lot')
                        ->where('land_id', $id)
                        ->orderBy('id', 'desc')
                        ->paginate(12);
        $data = [
            'title' => 'List LandLots',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'LandLot', 'route' => 'land.landlot', 'class' => 'active']
            ],
            'status' => $this->status,
            'lands' => $lands,
            'id' => $id
        ];
        return view('cms.land.landlot')->with($data);
     }
   
    
}