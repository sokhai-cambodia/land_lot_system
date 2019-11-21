<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use NotificationHelper;

use App\LandPayment;
use App\User;
use App\Land;
use DB;

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
        $date = date("m-Y");
        $reports = $this->getMonthlyReport($date);

        $data = [
            'title' => 'Report',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Report', 'route' => '', 'class' => 'active']
            ],
            "reports" => $reports,
            "month" => date("m")
        ];
        
        return view('cms.report.monthly')->with($data);
    }

    public function printMonthly()
    {
        $date = date("m-Y");
        $reports = $this->getMonthlyReport($date);

        $data = [
            "reports" => $reports,
            "month" => date("m")
        ];
        
        return view('cms.report.print.monthly')->with($data);
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
        $date = date('d-m-Y');

        $data = [
            'title' => 'Report',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Report', 'route' => '', 'class' => 'active']
            ],
            'reports' => $this->getSoldLandReport($date),
            'date' => $date
        ];
        
        return view('cms.report.sold-land')->with($data);
    }

    public function printSoldLand()
    {
        $date = date('d-m-Y');
        $data = [
            'reports' => $this->getSoldLandReport($date),
            'date' => $date
        ];
        
        return view('cms.report.print.sold-land')->with($data);
    }

    private function getSoldLandReport($date) {
        return LandPayment::join('lands', 'lands.id', 'land_payments.land_id')
                        ->join('users', 'users.id', 'land_payments.customer_id')
                        ->where(DB::raw("DATE_FORMAT(land_payments.created_at, '%d-%m-%Y')"), $date)
                        ->orderBy('land_payments.id')
                        ->select(
                            'land_payments.*',
                            'lands.title',
                            DB::raw("CONCAT(users.last_name, ' ', users.first_name) AS customer_name"),
                            "users.phone"
                        )
                        ->get();
    }

    private function getMonthlyReport($date) {
        return DB::select("
            SELECT
                DATE_FORMAT(rc.date, '%d-%m-%Y') AS date,
                rcc.`name` AS category_name,
                rc.type,
                SUM(price) as total
            FROM revenue_costs rc
            JOIN revenue_cost_categories rcc ON rcc.id = rc.category_id
            WHERE rc.deleted_at IS NULL 
                AND rcc.deleted_at IS NULL
                AND DATE_FORMAT(rc.date, '%m-%Y') = '$date'
            GROUP BY DATE_FORMAT(rc.date, '%d-%m-%Y'), rcc.name, rc.type
            ORDER BY DATE_FORMAT(rc.date, '%d-%m-%Y')
        ");
    }

}
