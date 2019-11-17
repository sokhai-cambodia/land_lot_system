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
            <form action="{{ route('land') }}" method="GET">
                <div class="row">
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="f_width" id="f_width" placeholder="From Width" value="{{ $filter['f_width'] }}">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="t_width" id="t_width" placeholder="To Width" value="{{ $filter['t_width'] }}">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="f_height" id="f_height" placeholder="From Height" value="{{ $filter['f_height'] }}">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="t_height" id="t_height" placeholder="To Height" value="{{ $filter['t_height'] }}">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="f_size" id="f_size" placeholder="From Size" value="{{ $filter['f_size'] }}">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="t_size" id="t_size" placeholder="To Size" value="{{ $filter['t_size'] }}">
                    </div>
                </div>
            
                <div class="row" style="margin-top: 10px">
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="f_price" id="f_price" placeholder="From Price" value="{{ $filter['f_price'] }}">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" name="t_price" id="t_price" placeholder="To Price" value="{{ $filter['t_price'] }}">
                    </div>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" step="0.01" max="100" name="commission" id="commission" placeholder="Commission" value="{{ $filter['commission'] }}">
                    </div>
                    <div class="col-sm-2">
                        <input type="name" class="form-control" name="title" id="title" placeholder="Title" value="{{ $filter['title'] }}">
                    </div>
                    <div class="col-sm-1">
                        <select name="status" id="status" class="form-control">
                            <option value="">Status</option>
                            @foreach ($status as $s)
                                <option value="{{ $s }}" {{ $filter['f_status'] != "" ? UtilHelper::selected($s, $filter['f_status']) : "" }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-1">
                        <select name="landType" id="landType" class="form-control">
                            <option value="">Type</option>
                            @foreach ($landType as $s)
                                <option value="{{ $s['key'] }}" {{ $filter['landType'] != "" ? UtilHelper::selected($s['key'], $filter['landType']) : "" }}>{{ $s['value'] }}</option>
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
                                        Type: {{ ucfirst($land->type) }} {{ $land->is_split_land_lot ? "(has land lot)" : "" }} <br>
                                        Width(m): {{ $land->width }} <br>
                                        Height(m): {{ $land->height }} <br>
                                        Size(m2): {{ $land->size }} <br>
                                        @if($land->is_split_land_lot)
                                            Avaible Land Lots: {{ $land->qty }} <br>
                                        @else
                                            Price($): {{ $land->price }} <br>
                                            Commission(%): {{ $land->commission }} <br>
                                        @endif
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
                                @if(!$land->is_split_land_lot)
                                    <a href="#" class="btn btn-sm bg-teal">
                                        Buy
                                    </a>
                                    <a href="#" class="btn btn-sm bg-teal">
                                        Installment
                                    </a>
                                    <a href="{{ route('land.update', ['id' => $land->id])}}" class="btn btn-sm bg-teal">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> View Info
                                    </a>
                                @else 
                                    <a href="{{ route('land.update', ['id' => $land->id])}}" class="btn btn-sm bg-teal">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('land.landlot', ['id' => $land->id])}}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> View Land Lot
                                    </a>
                                @endif

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