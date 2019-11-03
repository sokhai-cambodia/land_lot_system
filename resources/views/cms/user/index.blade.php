@extends('layouts.cms.template', compact('title','icon'))

@section('content')
 <!-- animation modal Dialogs start -->
<div class="modal fade" id="view-info" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">View User Information</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="model-body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!--animation modal  Dialogs ends -->

<!-- Default ordering table start -->
<div class="card">
    <div class="card-header">
        Filter
    </div>
    <div class="card-block">
        <form  method="GET">
            <div class="form-group row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <select class="form-control" name='role'>
                            <option value="">All Role</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ UtilHelper::selected($role->id, $f_role) }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-sm-7">
                    <div class="form-group">
                        <input class="form-control" type="text" placeholder="Search name, username, phone" name="search" value="{{ $f_search }}"/>
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
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Phone</th>
                        <th>Role</th>
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
                            <td>
                                <img src="{{ $row->getPhoto() }}" alt="image" style="width: 75px; heigh: 75px"/>
                            </td>
                            <td>{{ $row->getFullName() }}</td>
                            <td>{{ $row->username }}</td>
                            <td>{{ $row->gender }}</td>
                            <td>{{ $row->dob }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->role->name }}</td>
                            <td>{{ $row->status }}</td>
                            <td>
                                <div class="dropdown-success dropdown open">
                                    <button class="btn btn-success dropdown-toggle waves-effect waves-light " type="button" id="dropdown-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class="icofont icofont-check-circled"></i>Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown-2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item waves-light waves-effect" href="{{ route('user.update', ['id' => $row->id]) }}">Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item waves-light waves-effect" href="{{ route('user.toggle', ['id' => $row->id]) }}">
                                            {{ $row->status == 'active' ? 'Inactive' : 'Active' }}
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item waves-light waves-effect btn-delete" 
                                            href="javascript:void(0)"
                                            data-url="{{ route('user.delete', ['id' => $row->id ]) }}">Delete
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        {{-- <a class="dropdown-item waves-light waves-effect view-info" 
                                            href="javascript:void(0)"
                                            data-id="{{ $row->id }}">View Info</a> --}}
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

