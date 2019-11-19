@extends('layouts.cms.template', compact('title'))

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <a href="{{ UtilHelper::route('legal-service.process.create', ['id' => $legalService->id]) }}" class="btn btn-outline-success btn-flat float-right">Create</a>
                    </div>
                    <div class="col-md-12" style="margin-top: 20px">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 5%">
                                        #
                                    </th>
                                    <th style="width: 20%">
                                        Legal Service
                                    </th>
                                    <th style="width: 30%">
                                        Description
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Process (%)
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        {{ $legalService->title }}
                                    </td>
                                    <td>
                                        {{ $legalService->description }}
                                    </td>
                                    <td>
                                        {{ $legalService->status }}
                                    </td>
                                    <td>
                                        {{ $legalService->process_percent }}
                                    </td>
                                        
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <hr>
                    <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                                <tr>
                                    <th style="width: 5%">
                                        #
                                    </th>
                                    <th style="width: 30%">
                                        Start Date
                                    </th>
                                    <th style="width: 30%">
                                        Finished Date
                                    </th>
                                    <th style="width: 10%">
                                        Fee
                                    </th>
                                    <th style="width: 10%">
                                        Continue
                                    </th>
                                    <th style="width: 10%">
                                        Note
                                    </th>
                                    <th style="width: 10%">
                                        User
                                    </th>
                                    <th style="width: 10%">
                                        Status
                                    </th>
                                    <th style="width: 15%">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="tcontent">
                                @if(count($data) > 0)
                                    @php $no = 1 @endphp
                                    @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $d->start_date }}</td>
                                            <td>{{ $d->finished_date }}</td>
                                            <td>{{ $d->fee }}</td>
                                            <td>
                                                <span class="badge {{ $d->is_continue ? 'badge-success' : 'badge-warning' }}">
                                                    {{ $d->is_continue ? 'Yes' : 'No' }}
                                                </span>
                                            </td>
                                            <td>{{ $d->note }}</td>
                                            <td>{{ $d->user_id }}</td>
                                            <td>
                                                <span class="badge {{ $d->status == 'done' ? 'badge-success' : 'badge-warning' }}">{{ ucfirst($d->status) }}</span>
                                            </td>
                                            <td>
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown">
                                                    Action
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="{{ route('legal-service.process.finish', ['id' => $d->legal_service_id, 'pid' => $d->id]) }}">Finished</a>
                                                        <a class="dropdown-item" href="{{ route('legal-service.process.update', ['id' => $d->legal_service_id, 'pid' => $d->id]) }}">Edit</a>
                                                        <a class="dropdown-item" href="{{ route('document.process', ['processId' => $d->id]) }}">View Document</a>
                                                        <a class="dropdown-item" href="{{ route('document.process.create', ['processId' => $d->id]) }}">Upload Document</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="9" class="text-center">No data.!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>        
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

