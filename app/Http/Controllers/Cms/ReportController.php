<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use NotificationHelper;

use App\LandPayment;
use App\User;
use App\Land;

class ReportController extends Controller
{   
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function index()
    {
        $data = [
            'title' => 'Report',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Report', 'route' => '', 'class' => 'active']
            ],
        ];
        
        return view('cms.report.daily')->with($data);
    }

    public function monthly()
    {
        $data = [
            'title' => 'Report',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Report', 'route' => '', 'class' => 'active']
            ],
        ];
        
        return view('cms.report.monthly')->with($data);
    }

    public function printReceipt($id)
    {
        $payment = LandPayment::find($id);
        $witness = User::find($payment->witness1_id);
        $saler = User::find($payment->saler_id);
        $customer = User::find($payment->customer_id);
        $land = Land::find($payment->land_id);

        $data = [
            'payment' => $payment,
            'witness' => $witness,
            'saler' => $saler,
            'customer' => $customer,
            'land' => $land,
            'title' => 'Report',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Report', 'route' => '', 'class' => 'active']
            ],
        ];
        
        return view('cms.report.land-layout')->with($data);
    }

    public function soldLand()
    {
        $data = [
            'title' => 'Report',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Report', 'route' => '', 'class' => 'active']
            ],
        ];
        
        return view('cms.report.sold-land')->with($data);
    }

}
