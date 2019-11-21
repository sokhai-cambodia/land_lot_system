<?php

namespace App\Http\Controllers\Admin;

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
        $f_status = isset($request->status) ? $request->status : "";
        $f_width = isset($request->f_width) ? $request->f_width : "";
        $t_width = isset($request->t_width) ? $request->t_width : "";
        $f_height = isset($request->f_height) ? $request->f_height : "";
        $t_height = isset($request->t_height) ? $request->t_height : "";
        $f_size = isset($request->f_size) ? $request->f_size : "";
        $t_size = isset($request->t_size) ? $request->t_size : "";
        $f_price = isset($request->f_price) ? $request->f_price : "";
        $t_price = isset($request->t_price) ? $request->t_price : "";
        $commission = isset($request->commission) ? $request->commission : "";
        $title = isset($request->title) ? $request->title : "";

        $whereData = [];
        if($f_landType != "") {
            $whereData[] = ['is_split_land_lot', $f_landType];
        }
        if($f_status != "") {
            $whereData[] = ['status', $f_status];
        }
        if($f_width != "") {
            $whereData[] = ['width', '>=', $f_width];
        }
        if($t_width != "") {
            $whereData[] = ['width', '<=', $t_width];
        }
        if($f_height != "") {
            $whereData[] = ['height', '>=', $f_height];
        }
        if($t_height != "") {
            $whereData[] = ['height', '<=', $t_height];
        }
        if($f_size != "") {
            $whereData[] = ['size', '>=', $f_size];
        }
        if($t_size != "") {
            $whereData[] = ['size', '<=', $t_size];
        }
        if($f_price != "") {
            $whereData[] = ['price', '>=', $f_price];
        }
        if($t_price != "") {
            $whereData[] = ['price', '<=', $t_price];
        }
        if($commission != "") {
            $whereData[] = ['commission', $commission];
        }
        if($title != "") {
            $whereData[] = ['title', 'LIKE' , "%".$title."%"];
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
                'landType' => $f_landType,
                'f_status' => $f_status,
                'f_width' => $f_width,
                't_width' => $t_width,
                'f_height' => $f_height,
                't_height' => $t_height,
                'f_size' => $f_size,
                't_size' => $t_size,
                'f_price' => $f_price,
                't_price' => $t_price,
                'commission' => $commission,
                'title' => $title,
                
            ]
        ];
        return view('admin.land.index')->with($data);
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
        return view('admin.land.create')->with($data);
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
        
        return view('admin.land.edit')->with($data);
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

            //  Land has land lot not display
            if(!($land->type == "land" && $land->is_split_land_lot == 1)) {
                $request->validate([
                    'price' => 'required|min:0',
                    'commission' => 'required|min:0|max:100',
                ]);
                
                $land->price = $request->price;
                $land->commission = $request->commission;
            }

            if($request->hasFile('image')) {
                $land->image = FileHelper::updateImage($request->image, $land->image, '');
            }

            $land->title = $request->title;
            $land->description = $request->description;
            $land->size = $request->size;
            $land->width = $request->width;
            $land->height = $request->height;
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
        return view('admin.land.create-land-lot')->with($data);
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
    public function landLot(Request $request, $id)
    {
        $land = Land::find($id);
        if($land == null) {
            NotificationHelper::setWarningNotification('Invalid Land');
            return redirect()->route('land');
        }
        // TODO: query by condition
        $f_status = isset($request->status) ? $request->status : "";
        $f_width = isset($request->f_width) ? $request->f_width : "";
        $t_width = isset($request->t_width) ? $request->t_width : "";
        $f_height = isset($request->f_height) ? $request->f_height : "";
        $t_height = isset($request->t_height) ? $request->t_height : "";
        $f_size = isset($request->f_size) ? $request->f_size : "";
        $t_size = isset($request->t_size) ? $request->t_size : "";
        $f_price = isset($request->f_price) ? $request->f_price : "";
        $t_price = isset($request->t_price) ? $request->t_price : "";
        $commission = isset($request->commission) ? $request->commission : "";
        $title = isset($request->title) ? $request->title : "";

        $whereData = [];
        if($f_status != "") {
            $whereData[] = ['status', $f_status];
        }
        if($f_width != "") {
            $whereData[] = ['width', '>=', $f_width];
        }
        if($t_width != "") {
            $whereData[] = ['width', '<=', $t_width];
        }
        if($f_height != "") {
            $whereData[] = ['height', '>=', $f_height];
        }
        if($t_height != "") {
            $whereData[] = ['height', '<=', $t_height];
        }
        if($f_size != "") {
            $whereData[] = ['size', '>=', $f_size];
        }
        if($t_size != "") {
            $whereData[] = ['size', '<=', $t_size];
        }
        if($f_price != "") {
            $whereData[] = ['price', '>=', $f_price];
        }
        if($t_price != "") {
            $whereData[] = ['price', '<=', $t_price];
        }
        if($commission != "") {
            $whereData[] = ['commission', $commission];
        }
        if($title != "") {
            $whereData[] = ['title', 'LIKE' , "%".$title."%"];
        }
        // query land lots
        $lands = Land::where('type', 'land_lot')
                        ->where('land_id', $id)
                        ->where($whereData)
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
            'id' => $id,
            'filter' => [
                'f_status' => $f_status,
                'f_width' => $f_width,
                't_width' => $t_width,
                'f_height' => $f_height,
                't_height' => $t_height,
                'f_size' => $f_size,
                't_size' => $t_size,
                'f_price' => $f_price,
                't_price' => $t_price,
                'commission' => $commission,
                'title' => $title,
                
            ]
        ];
        return view('admin.land.landlot')->with($data);
     }
   
    
}
