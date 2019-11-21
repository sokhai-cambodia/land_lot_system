@extends('layouts.admin.template', compact('title'))

@section('content')

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <a href="{{ UtilHelper::route('legal-service') }}" class="btn btn-outline-success btn-flat float-right">Legal Service</a>
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
                    <form role="form" action="{{ route('legal-service.process.update', ['id' => $process->legal_service_id, 'pid' => $process->id]) }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user">Customer</label>
                                <select name="user" id="user" class="form-control select2">
                                    @foreach ($users as $user)
                                        @php 
                                            $sSelected = UtilHelper::hasValue(old('user'), $process->user_id);
                                        @endphp
                                        <option value="{{ $user->id }}" {{  UtilHelper::selected($user->id, $sSelected) }}>{{ $user->getFullName() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- text input -->   
                            <div class="form-group">
                                <label for="start_date">Start Date</label>
                                <input type="date" class="form-control" name="start_date" id="start_date" placeholder="Enter start_date" value="{{ UtilHelper::hasValue(old('start_date'), date('Y-m-d', strtotime($process->start_date))) }}">
                            </div>
                            <div class="form-group">
                                <label for="finished_date">Finished Date</label>
                                <input type="date" class="form-control" name="finished_date" id="finished_date" placeholder="Enter finished_date" value="{{ UtilHelper::hasValue(old('finished_date'), date('Y-m-d', strtotime($process->finished_date))) }}">
                            </div>
                            <div class="form-group">
                                <label for="fee">Fee</label>
                                <input type="number" class="form-control" min="0" step="0.01" name="fee" id="fee" placeholder="Enter fee" value="{{ UtilHelper::hasValue(old('fee'), $process->fee) }}">
                            </div>
                            <div class="form-group">
                                <label for="note">Note</label>
                                <textarea class="form-control" name="note" id="note" placeholder="Enter note" rows="5">{{ UtilHelper::hasValue(old('note'), $process->note) }}</textarea>
                            </div>   
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    @php 
                                        $chk = UtilHelper::hasValue(old('is_continue'), $process->is_continue);
                                    @endphp
                                    <input type="checkbox" id="is_continue" name="is_continue" {{ UtilHelper::checked($chk, 1) }} >
                                    <label for="is_continue">
                                        Continue Process
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </div>
                    </form>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->

@endsection

@section('footer')

<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
        theme: 'bootstrap4'
        })
    });
</script>
@endsection