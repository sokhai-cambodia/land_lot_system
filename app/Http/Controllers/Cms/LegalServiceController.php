<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LandPayment;
use App\LegalService;
use App\Land;
use App\LegalServiceProcess;
use App\User;
use Auth;
use NotificationHelper;
use DB;

class LegalServiceController extends Controller
{
    private $contentHeaders = ['name' => 'Dashboard', 'route' => 'cms', 'class' => ''];

    public function index()
    {
        $data = [
            'title' => 'List Legal Service',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Legal Service', 'route' => '', 'class' => 'active']
            ],
            
        ];
        return view('cms.legal-service.index')->with($data);
    }

    public function create($paymentId)
    {
        $payment = LandPayment::find($paymentId);
        if($payment == null) {
            NotificationHelper::setWarningNotification('Invalid Payment');
            return redirect()->back();
        }

        $legalService = LegalService::where('land_payment_id', $payment->id)->first();
        if($legalService != null) {
            // will redirect to legal service process list
            return redirect()->route('legal-service.process', ['id' => $legalService->id]);
        }

        $land = Land::where('id', $payment->land_id)->first();
        if($land == null) {
            NotificationHelper::setWarningNotification('Invalid Land');
            return redirect()->back();
        }

        $data = [
            'title' => 'Create Legal Service',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Legal Service', 'route' => '', 'class' => 'active']
            ],
            'land' => $land,
            'paymentId' => $paymentId
        ];
        return view('cms.legal-service.create')->with($data);
    }

    public function store(Request $request, $paymentId) {
        $request->validate([
            'title' =>'required',
            'description' => 'required',
        ]);

        $payment = LandPayment::find($paymentId);
        if($payment == null) {
            NotificationHelper::setWarningNotification('Invalid Payment');
            return redirect()->back();
        }

        LegalService::create([
            'company_id' => Auth::user()->company_id,
            'land_payment_id' => $payment->id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'on_process',
            'process_percent' => 0,
            'created_by' => Auth::id(),
        ]);
        
        NotificationHelper::setSuccessNotification('Create Legal Service Success.');
        return redirect()->route('legal-service');

    }

    public function edit($id)
    {
        $legalService = LegalService::find($id);
        if($legalService == null) {
            NotificationHelper::setWarningNotification('Invalid Legal Service');
            return redirect()->back();
        }

        $payment = LandPayment::find($legalService->land_payment_id);
        if($payment == null) {
            NotificationHelper::setWarningNotification('Invalid Payment');
            return redirect()->back();
        }

        $land = Land::where('id', $payment->land_id)->first();
        if($land == null) {
            NotificationHelper::setWarningNotification('Invalid Land');
            return redirect()->back();
        }

        $data = [
            'title' => 'Edit Legal Service',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Edit Legal Service', 'route' => '', 'class' => 'active']
            ],
            'land' => $land,
            'row' => $legalService,
            'status' => ['completed', 'on_process']
        ];
        return view('cms.legal-service.edit')->with($data);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'title' =>'required',
            'process_percent' =>'required|min:0|max:100',
            'description' => 'required',
        ]);

        $legalService = LegalService::find($id);
        if($legalService == null) {
            NotificationHelper::setWarningNotification('Invalid Legal Service');
            return redirect()->back();
        }

        $legalService->title = $request->title;
        $legalService->description = $request->description;
        $legalService->status = $request->status;
        $legalService->process_percent = $request->process_percent;
        $legalService->updated_by = Auth::id();
        $legalService->save();

        NotificationHelper::setSuccessNotification('Edit Legal Service Success.');
        return redirect()->route('legal-service');

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
            $searchQuery = " and (title LIKE '%$searchValue%') ";
        }
        

        //  Total number of records without filtering
        //  $totalRecords = User::where('role', $role)->where('status', 'active')->count();

        //  Total number of record with filtering
        $totalRecordwithFilter = LegalService::whereRaw('1=1'.$searchQuery)->count();
        
        ## Fetch records
        $records = LegalService::whereRaw('1=1'.$searchQuery)
                    ->orderBy($columnName, $columnSortOrder)
                    ->offset($row)
                    ->limit($rowPerPage)
                    ->get();

        $data = array();

        foreach($records as $record) {
            
            $routeEdit = route("legal-service.update", ["id" => $record->id]);
            $routeProcess = route("legal-service.process", ["id" => $record->id]);

            $actions = "<a class='dropdown-item' href='$routeProcess'>Process List</a>";
            $actions .= "<a class='dropdown-item' href='$routeEdit'>Edit</a>";

            $data[] = [
                "land_payment_id" => $record->land_payment_id,
                "title" => $record->title,
                "description" => $record->description,
                "status" => $record->status,
                "process_percent" => $record->process_percent,
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

    // Process
    public function process($id)
    {
        $legalService = LegalService::find($id);
        if($legalService == null) {
            NotificationHelper::setWarningNotification('Invalid Legal Service');
            return redirect()->back();
        }

        $legalProcesses = LegalServiceProcess::where('legal_service_id', $id)
                                            ->orderBy('id', 'desc')
                                            ->get();

        $data = [
            'title' => 'List Legal Service',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Legal Service', 'route' => 'legal-service', 'class' => ''],
                ['name' => 'Process', 'route' => '', 'class' => 'active']
            ],
            'data' => $legalProcesses,
            'legalService' => $legalService
        ];
        return view('cms.legal-service.process')->with($data);
    }

    public function createProcess($id)
    {
        $legalService = LegalService::find($id);
        if($legalService == null) {
            NotificationHelper::setWarningNotification('Invalid Legal Service');
            return redirect()->back();
        }
        
        $users = User::where('role', 'staff')->get();

        $data = [
            'title' => 'Create Process',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Legal Service', 'route' => 'legal-service', 'class' => ''],
                ['name' => 'Process', 'route' => 'legal-service.process', 'routeParam' => ['id' => $id], 'class' => 'active']
            ],
            'legalService' => $legalService,
            'users' => $users
        ];
        return view('cms.legal-service.create-process')->with($data);
    }

    public function storeProcess(Request $request, $id) {
        $request->validate([
            'user' =>'required',
            'start_date' => 'required',
            'finished_date' => 'required',
            'fee' => 'required',
        ]);

        $legalService = LegalService::find($id);
        if($legalService == null) {
            NotificationHelper::setWarningNotification('Invalid Legal Service');
            return redirect()->back();
        }

        $is_continue = isset($request->is_continue);

        LegalServiceProcess::create([
            'legal_service_id' => $legalService->id,
            'user_id' => $request->user,
            'start_date' => $request->start_date,
            'finished_date' => $request->finished_date,
            'fee' => $request->fee,
            'note' => $request->note,
            'is_continue' => $is_continue,
            'status' => 'on_process',
            'created_by' => Auth::id(),
        ]);
        
        NotificationHelper::setSuccessNotification('Create Legal Service Success.');
        return redirect()->route('legal-service.process', ['id' => $id]);

    }

    public function editProcess($id, $pid)
    {
        $legalService = LegalService::find($id);
        if($legalService == null) {
            NotificationHelper::setWarningNotification('Invalid Legal Service');
            return redirect()->back();
        }
        
        $process = LegalServiceProcess::where('id', $pid)
                                        ->where('legal_service_id', $id)
                                        ->first();

        if($process == null) {
            NotificationHelper::setWarningNotification('Invalid Process');
            return redirect()->back();
        }

        $users = User::where('role', 'staff')->get();

        $data = [
            'title' => 'Edit Process',
            'contentHeaders' => [
                $this->contentHeaders,
                ['name' => 'Legal Service', 'route' => 'legal-service', 'class' => ''],
                ['name' => 'Process', 'route' => 'legal-service.process', 'routeParam' => ['id' => $id], 'class' => 'active']
            ],
            'legalService' => $legalService,
            'process' => $process,
            'users' => $users
        ];
        return view('cms.legal-service.edit-process')->with($data);
    }

    public function updateProcess(Request $request, $id, $pid) {
        $request->validate([
            'user' =>'required',
            'start_date' => 'required',
            'finished_date' => 'required',
            'fee' => 'required',
        ]);

        $legalService = LegalService::find($id);
        if($legalService == null) {
            NotificationHelper::setWarningNotification('Invalid Legal Service');
            return redirect()->back();
        }

        $process = LegalServiceProcess::where('id', $pid)
                                        ->where('legal_service_id', $id)
                                        ->first();
        if($process == null) {
            NotificationHelper::setWarningNotification('Invalid Process');
            return redirect()->back();
        }

        $is_continue = isset($request->is_continue);

        
        $process->user_id = $request->user;
        $process->start_date = $request->start_date;
        $process->finished_date = $request->finished_date;
        $process->fee = $request->fee;
        $process->note = $request->note;
        $process->is_continue = $is_continue;
        $process->updated_by = Auth::id();
        $process->save();
        
        NotificationHelper::setSuccessNotification('Create Legal Service Success.');
        return redirect()->route('legal-service.process', ['id' => $id]);

    }

    public function finishProcess(Request $request, $id, $pid)
    {
        $legalService = LegalService::find($id);
        if($legalService == null) {
            NotificationHelper::setWarningNotification('Invalid Legal Service');
            return redirect()->back();
        }

        $process = LegalServiceProcess::where('id', $pid)
                                        ->where('legal_service_id', $id)
                                        ->first();
        if($process == null) {
            NotificationHelper::setWarningNotification('Invalid Process');
            return redirect()->back();
        }

        try
        {
            DB::transaction(function () use($request, &$process, &$legalService) {
                //
                if($process->is_continue == 0) {
                    $legalService->status = 'completed';
                    $legalService->process_percent = 100;
                    $legalService->updated_by = Auth::id();
                    $legalService->save();
                }

                $process->status = 'done';
                $process->updated_by = Auth::id();
                $process->save();
            });
            NotificationHelper::setSuccessNotification('Process Success');
            return redirect()->route('legal-service.process', ['id' => $id]);
        }
        catch (\Exception $e) 
        {
            NotificationHelper::errorNotification($e);
            return back()->withInput();
        }
        
    }

}
