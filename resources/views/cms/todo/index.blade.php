@extends('layouts.cms.template', compact('title','icon'))

@section('content')

<!-- Default ordering table start -->
<div class="card">
    <div class="card-header">
        Filter
    </div>
    <div class="card-block">
        <form  method="GET">
            <div class="form-group row">
                
                <div class="col-sm-10">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Search name" name="search" value="{{ $f_search }}"/>
                    </div>
                </div>

                <div class="col-sm-2">
                    <div class="form-group">
                        <button class="btn waves-effect waves-light hor-grd btn-grd-primary ">Search<i class="fas fa-search" style="margin-left:10px;"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h5>{{ $title }}</h5>
    </div>
    <div class="card-block">
        <div class="dt-responsive table-responsive">
            <table id="listing" class="table table-striped table-bordered nowrap" style="width: 100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $no = 1;
                    @endphp
                    @foreach ($data as $row)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->description }}</td>
                            <td>{{ $row->status }}</td>
                            <td>
                                <div class="dropdown-success dropdown open">
                                    <button class="btn btn-success dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="icofont icofont-check-circled"></i>Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item waves-light waves-effect" href="{{ route('todo.update', ['id' => $row->id]) }}">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item waves-light waves-effect btn-delete" 
                                            href="javascript:void(0)"
                                            data-url="{{ route('todo.delete', ['id' => $row->id ]) }}">Delete
                                        </a>
                                        <div class="dropdown-divider"></div>
                                       
                                    </div>
                                </div>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
               
            </table>
        </div>
        {{-- pagenation --}}
        <nav aria-label="Page navigation example">
            {{ $data->appends(request()->input())->links() }}
        </nav>
        {{--! end pagenation --}}
    </div>
</div>
<!-- Default ordering table end -->
@endsection

@section('footer-src')

    <script>
        $(document).ready(function() {
            // delete popup
            $('body').on('click', '.btn-delete', function() {
                var url = $(this).attr('data-url');
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3f51b5',
                    cancelButtonColor: '#ff4081',
                    confirmButtonText: 'Great ',
                    buttons: {
                        cancel: {
                            text: "Cancel",
                            value: null,
                            visible: true,
                            className: "btn btn-danger",
                            closeModal: true,
                        },
                        confirm: {
                            text: "OK",
                            value: true,
                                visible: true,
                            className: "btn btn-primary",
                            closeModal: true
                        }
                    }
                }).then((result) => {
                    if (result) {
                        window.location.href = url;
                    }
                })
            });

          
        });
    </script>
@endsection

