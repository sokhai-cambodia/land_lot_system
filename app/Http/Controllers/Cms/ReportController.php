<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use NotificationHelper;


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

    public function landLayout()
    {
        $data = [
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
