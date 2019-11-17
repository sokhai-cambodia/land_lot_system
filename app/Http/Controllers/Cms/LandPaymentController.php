<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Land;
use App\LandPayment;
use NotificationHelper;
use DB;
use Auth;

class LandPaymentController extends Controller
{
    
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function index()
    {
        //
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
        dd('save installment: ', $request->all(), $landId);
    }
    
}
