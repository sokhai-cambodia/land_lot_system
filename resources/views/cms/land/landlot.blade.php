
@extends('layouts.cms.template', compact('title'))

@section('header')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('cms/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
@endsection

@section('content')
<!-- Content Header (Page header) -->
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-header">
            <form action="{{ route('land.landlot') }}" method="GET">
                <div class="row">
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="f_width" id="f_width" placeholder="From Width">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="t_width" id="t_width" placeholder="To Width">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="f_height" id="f_height" placeholder="From Height">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="t_height" id="t_height" placeholder="To Height">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="f_size" id="f_size" placeholder="From Size">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="t_size" id="t_size" placeholder="To Size">
                    </div>
                </div>
            
                <div class="row" style="margin-top: 10px">
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="f_price" id="f_price" placeholder="From Price">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="t_price" id="t_price" placeholder="To Price">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" max="100" name="commission" id="commission" placeholder="Commission">
                    </div>
                    <div class="col-sm-2">
                        <input type="name" class="form-control" name="title" id="title" placeholder="Title">
                    </div>
                    <div class="col-sm-2">
                        <select name="status" id="status" class="form-control">
                            <option value="">Select Status</option>
                            @foreach ($status as $s)
                                @php 
                                    $sSelected = UtilHelper::hasValue(old('status'), "");
                                @endphp
                                <option value="{{ $s }}" {{  UtilHelper::selected($s, $sSelected) }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="form-control btn btn-outline-success btn-flat">Search</button>
                    </div>
                </div>
            </form>    
        </div>
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                @foreach($lands as $land)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            {{ $land->title }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <p class="text-muted text-sm">
                                        Width(m): {{ $land->width }} <br>
                                        Height(m): {{ $land->height }} <br>
                                        Size(m2): {{ $land->size }} <br>
                                        Price($): {{ $land->price }} <br>
                                        Commission(%): {{ $land->commission }} <br>
                                        Type: {{ ucfirst($land->type) }} <br>
                                        Status: {{ ucfirst($land->status) }}
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Location: {{ $land->location }}</li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-info-circle"></i></span> Description: {{ $land->description }}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ $land->getPhoto() }}" alt="" class="img-fluid" style="width: 128px; height: 128px;">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="{{ route('land.update', ['id' => $land->id])}}" class="btn btn-sm bg-teal">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Land Lot
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            {{-- pagenation --}}
            <nav aria-label="Contacts Page Navigation">
                {{ $lands->appends(request()->input())->links("pagination::bootstrap-4") }}
            </nav>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->
@endsection

@section('footer')
<!-- page script -->
@include('layouts.message.delete-confirm')
@endsection