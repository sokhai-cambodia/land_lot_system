<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\User;
use App\Land;
use NotificationHelper;

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
        $land = Land::find($landId);
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
    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LandPayment  $landPayment
     * @return \Illuminate\Http\Response
     */
    public function show(LandPayment $landPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LandPayment  $landPayment
     * @return \Illuminate\Http\Response
     */
    public function edit(LandPayment $landPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LandPayment  $landPayment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LandPayment $landPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LandPayment  $landPayment
     * @return \Illuminate\Http\Response
     */
    public function destroy(LandPayment $landPayment)
    {
        //
    }
}
