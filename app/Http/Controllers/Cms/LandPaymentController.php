<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Land;
use App\LandPayment;
use App\InstallmentPayment;
use NotificationHelper;
use DB;
use Auth;

class LandPaymentController extends Controller
{
    
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function index()
    {
        $data = [
            'title' => 'List Payment',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'List Payment', 'route' => 'land.payment', 'class' => 'active']
            ],
            
        ];
        return view('cms.land-payment.index')->with($data);
    }

    // Create Payment 
    public function create($landId)
    {
        $land = Land::where('id', $landId)
                    ->where('status', 'on_sale')
                    ->first();
        if($land == null) {
            NotificationHelper::setWarningNotification('Invalid Land');
            return redirect()->route('land');
        }

        $customers = User::where('role', 'customer')->get();
        $witnesses = User::where('role', 'witness')->get();
        $brokers = User::where('role', 'staff')->get();
        $data = [
            'title' => 'Create Payment',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Land', 'route' => 'land', 'class' => 'active']
            ],
            'customers' => $customers,
            'witnesses' => $witnesses,
            'brokers' => $brokers,
            'land' => $land
        ];
        return view('cms.land-payment.create')->with($data);
    }

    // Store payment
    public function store(Request $request, $landId)
    {
        $request->validate([
            'customer' =>'required|min:0',
            'broker' => 'required|min:0',
            'witness1' => 'required|min:0',
            'price' => 'required|min:0',
            'discount' => 'required|min:0|max:100',
            'receive' => 'required|min:0|max:100',
        ]);
        
        $land = Land::where('id', $landId)
                    ->where('status', 'on_sale')
                    ->first();
        if($land == null) {
            NotificationHelper::setWarningNotification('Invalid Land');
            return redirect()->route('land');
        }

        try
        {
            DB::transaction(function () use($request, $land) {
                $price = $request->price;
                // calculate commission
                $commission = $land->commission * $price / 100;
                
                // calculate discount
                $price_after_discount = $price - ($request->discount * $price / 100);
                $deposit = $request->receive < $price_after_discount ? $request->receive : 0;
                $receive = $request->receive >= $price_after_discount ? $price_after_discount : 0;
                $status = $request->receive < $price_after_discount ? "booked" : "sold";

                // create land payment
                $landPayment = LandPayment::create([
                    'company_id' => Auth::id(),
                    'land_id' => $land->id,
                    'saler_id' => Auth::id(),
                    'customer_id' => $request->customer,
                    'broker_id' => $request->broker,
                    'witness1_id' => $request->witness1,
                    'witness2_id' => $request->witness2,
                    'witness3_id' => $request->witness3,
                    'price' => $price,
                    'deposit' => $deposit,
                    'receive' => $receive,
                    'discount' => $request->discount,
                    'comission' => $commission,
                    'payment_type' => 'completed_payment',
                    'status' => $status,
                    'installment_type' => 'none',
                    'installment_total' => 0,
                    'installment_process' => 0,
                    'created_by' => Auth::id()
                ]);
                
                // update land status
                $land->status = $status;
                $land->save();
                // Save to RevenueCost
                // $landPayment
            });
            NotificationHelper::setSuccessNotification('Payment Success');
            return redirect()->route('land');
        }
        catch (\Exception $e) 
        {
            dd($e);
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }

    }


    // Installment

    // Create Payment 
    public function createInstallment($landId)
    {
        $land = Land::where('id', $landId)
                    ->where('status', 'on_sale')
                    ->first();
        if($land == null) {
            NotificationHelper::setWarningNotification('Invalid Land');
            return redirect()->route('land');
        }

        $customers = User::where('role', 'customer')->get();
        $witnesses = User::where('role', 'witness')->get();
        $brokers = User::where('role', 'staff')->get();
        $data = [
            'title' => 'Create Installment Payment',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Land', 'route' => 'land', 'class' => 'active']
            ],
            'customers' => $customers,
            'witnesses' => $witnesses,
            'brokers' => $brokers,
            'land' => $land,
            'installmentType' => ['weekly', 'monthly']
        ];
        return view('cms.land-payment.create-installment')->with($data);
    }

    public function storeInstallment(Request $request, $landId) 
    {
        $request->validate([
            'customer' =>'required|min:0',
            'broker' => 'required|min:0',
            'witness1' => 'required|min:0',
            'price' => 'required|min:0',
            'discount' => 'required|min:0|max:100',
            'deposit' => 'required|min:0|max:100',
            'installment_type' => 'required',
            'duration' => 'required|min:1',
            'installment_date' => 'required',
            'installment_price' => 'required',
        ]);

        $land = Land::where('id', $landId)
                    ->where('status', 'on_sale')
                    ->first();
        if($land == null) {
            NotificationHelper::setWarningNotification('Invalid Land');
            return redirect()->route('land');
        }

        try
        {
            DB::transaction(function () use($request, $land) {
                $price = $request->price;
                // calculate commission
                $commission = $land->commission * $price / 100;
                
                // calculate discount
                $price_after_discount = $price - ($request->discount * $price / 100);
                
                // create land payment
                $landPayment = LandPayment::create([
                    'company_id' => Auth::id(),
                    'land_id' => $land->id,
                    'saler_id' => Auth::id(),
                    'customer_id' => $request->customer,
                    'broker_id' => $request->broker,
                    'witness1_id' => $request->witness1,
                    'witness2_id' => $request->witness2,
                    'witness3_id' => $request->witness3,
                    'price' => $price,
                    'deposit' => $request->deposit,
                    'receive' => 0,
                    'discount' => $request->discount,
                    'comission' => $commission,
                    'payment_type' => 'installment_payment',
                    'status' => 'installment_process',
                    'installment_type' => $request->installment_type,
                    'installment_total' => $request->duration,
                    'installment_process' => 0,
                    'created_by' => Auth::id()
                ]);
                
                // update land status
                $land->status = 'sold';
                $land->save();
                
                // Save Installment Payment
                $installment_date = $request->installment_date;
                $installment_price = $request->installment_price;
                $installments = [];
                for($i = 0; $i < count($installment_date); $i++) {
                    $installments[] = [
                        'company_id' => $landPayment->company_id,
                        'land_payment_id' => $landPayment->id,
                        'installment_date' => $installment_date[$i],
                        'price' => $installment_price[$i],
                        'type' => $request->installment_type,
                        'created_by' => Auth::id(),
                    ];
                }
                InstallmentPayment::insert($installments);

                // Save to RevenueCost
                // $landPayment
            });
            NotificationHelper::setSuccessNotification('Payment Success');
            return redirect()->route('land');
        }
        catch (\Exception $e) 
        {
            dd($e);
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
    }

    public function generateInstallment(Request $request)
    {
        $price = $request->price;
        $price_after_discount = $price - ($request->discount * $price / 100) - $request->deposit;
        $duration = $request->duration;
        $monthly_price = number_format($price_after_discount / $duration, 2);
        $installment_type = $request->installment_type == "weekly" ? "weeks" : "months";
        
        $start_date = date("Y-m-d", strtotime($request->start_date));
        $end_date = date("Y-m-d", strtotime("+$duration $installment_type", strtotime($start_date)));
        
        $installmentData = [];
        while($start_date < $end_date) {
            $installmentData[] = [
                "date" => date("Y-m-d", strtotime($start_date)),
                "price" => $monthly_price
            ];
            $start_date = date("Y-m-d", strtotime("+1 $installment_type", strtotime($start_date)));
        }

        $data = view('cms.land-payment.generate-installment')
                ->with(["data" => $installmentData])
                ->render();

        return response()->json([
            'status' => 1,
            'data' => $data
        ]);
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
        // $searchQuery = " ";
        // if($searchValue != ''){
        //     $searchQuery = " and (customer LIKE '%$searchValue%' OR broker LIKE '%$searchValue%') ";
        // }
        $searchQuery = " and (CONCAT(c.last_name, '', c.first_name) LIKE '%$searchValue%' OR CONCAT(b.last_name, '', b.first_name) LIKE '%$searchValue%') ";

        //  Total number of records without filtering
        //  $totalRecords = User::where('role', $role)->where('status', 'active')->count();

        //  Total number of record with filtering
        $totalRecordwithFilter = LandPayment::join('users AS b', 'b.id', 'land_payments.broker_id')
                                    ->join('users AS c', 'c.id', 'land_payments.customer_id')
                                    ->whereRaw('1=1'.$searchQuery)
                                    ->count();
        
        ## Fetch records
        $records = LandPayment::join('users AS b', 'b.id', 'land_payments.broker_id')
                    ->join('users AS c', 'c.id', 'land_payments.customer_id')
                    ->select(
                        'land_payments.*', 
                        DB::raw("CONCAT(c.last_name, '', c.first_name) AS customer"),
                        DB::raw("CONCAT(b.last_name, '', b.first_name) AS broker")
                    )
                    ->whereRaw('1=1'.$searchQuery)
                    ->orderBy($columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            $actions = "<a class='dropdown-item' href='#'>View Invoice</a>";
            $status = "";
            if($record->payment_type == "completed_payment" && $record->status == "booked") {
                $actions .= "<a class='dropdown-item' href='#'>Pay More</a>";
                $status = "<span class='badge badge-warning'>Booked</span>";
            } elseif( $record->payment_type == "installment_payment" && $record->status == "installment_process" ) {
                $routeInstallment = route('land.installment-payment', ['paymentId' => $record->id]);
                $actions .= "<a class='dropdown-item' href='$routeInstallment'>View Installment</a>";
                
                $percent = $record->installment_process / $record->installment_total * 100;
                $status = "
                    <div class='progress progress-sm'>
                        <div class='progress-bar bg-green' role='progressbar' aria-volumenow='$percent' aria-volumemin='0' aria-volumemax='100' style='width: $percent%'>
                        </div>
                    </div>
                    <small>$percent%</small>
                ";
            } elseif( $record->payment_type == "installment_payment" && $record->status == "installment_done" ) {
                $routeInstallment = route('land.installment-payment', ['paymentId' => $record->id]);
                $actions .= "<a class='dropdown-item' href='$routeInstallment'>View Installment</a>";
                
                $status = "
                    <div class='progress progress-sm'>
                        <div class='progress-bar bg-green' role='progressbar' aria-volumenow='100' aria-volumemin='0' aria-volumemax='100' style='width: 100%'>
                        </div>
                    </div>
                    <small>100%</small> 
                ";
            } else {
                $status = "<span class='badge badge-success'>Paid</span>";
            }

            $data[] = [
                "customer_id" => $record->customer,
                "broker_id" => $record->broker,
                "price" => $record->price,
                "deposit" => $record->deposit,
                "receive" => $record->receive,
                "discount" => $record->discount,
                "comission" => $record->comission,
                "payment_type" => $record->payment_type,
                "status" => $status,
                "action" => "
                    <div class='dropdown'>
                        <button type='button' class='btn btn-default btn-sm dropdown-toggle' data-toggle='dropdown'>
                        Action
                        </button>
                        <div class='dropdown-menu'>
                            $actions
                        </div>
                    </div>
                ",
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

    public function installmentList($paymentId)
    {
        $payment = LandPayment::find($paymentId);
        if($payment == null || $payment->payment_type != 'installment_payment') {
            NotificationHelper::setWarningNotification('Invalid Payment');
            return redirect()->route('land.payment');
        }

        $installments = InstallmentPayment::where('land_payment_id', $paymentId)
                                            ->orderBy('installment_date', 'asc')
                                            ->get();
        
        if($installments == null || count($installments) < 1) {
            NotificationHelper::setWarningNotification('Installment has no data');
            return redirect()->route('land.payment');
        }

        $land = Land::find($payment->land_id);
        if($land == null) {
            NotificationHelper::setWarningNotification('Invalid Land');
            return redirect()->route('land.payment');
        }


        $data = [
            'title' => 'Installment List',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'List Payment', 'route' => 'land.payment', 'class' => ''],
                ['name' => 'Installment', 'route' => '', 'class' => 'active']
            ],
            'installments' => $installments,
            'land' => $land
        ];
        return view('cms.land-payment.installment-list')->with($data);
    }

    public function installmentPay(Request $request, $id) {
        $request->validate([
            'receive' => 'required|min:0',
        ]);

        $installment = InstallmentPayment::find($id);
        if($installment == null) {
            NotificationHelper::setWarningNotification('Invalid Id');
            return redirect()->back();
        }

        if($installment->status == 'paid') {
            NotificationHelper::setWarningNotification('Paid already');
            return redirect()->back();
        }

        if($request->receive < $installment->price) {
            NotificationHelper::setWarningNotification('Receive amount smaller than installment price');
            return redirect()->back();
        }

        $installment->status = "paid";
        $installment->receive = $request->receive;
        $installment->receiver_id = Auth::id();
        $installment->paid_date = date("Y-m-d H:i:s");
        $installment->note = $request->note;
        $installment->save();

        NotificationHelper::setSuccessNotification('Installment paid successfully.');
        return redirect()->back();
    }

    public function installmentDetail(Request $request) {
        
        $id = $request->id;
        $installment = InstallmentPayment::find($id);
        if($installment == null) {
            return response()->json(['status' => 0]);
        }

        $user = User::find($installment->receiver_id);
        if($user == null) {
            return response()->json(['status' => 0]);
        }

        return response()->json([
            'status' => 1,
            'installment' => $installment,
            'receiver' => $user->getFullName()
        ]);
    }
    
}
