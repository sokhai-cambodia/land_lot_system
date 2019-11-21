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
                        <a href="{{ UtilHelper::route('document.user', ['userId' => $userId]) }}" class="btn btn-outline-success btn-flat float-right">Document User List</a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form role="form" action="{{ route('document.user.create', ['userId' => $userId]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body p-0">
                            <table class="table table-striped projects">
                                <thead>
                                    <tr>
                                        <th style="width: 1%">
                                            #
                                        </th>
                                        <th style="width: 20%">
                                            Document
                                        </th>
                                        <th style="width: 30%">
                                            Name
                                        </th>
                                        <th>
                                            Description
                                        </th>
                                        <th style="width: 8%" class="text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="tcontent">
                                    <tr>
                                        <td>
                                            #
                                        </td>
                                        <td>
                                            <div class="form-group row">
                                                <input type="file" name="files[]" class="form-control dropify">
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <textarea class="form-control" name="names[]" id="name" placeholder="Enter name" rows="7"></textarea>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <textarea class="form-control" name="descriptions[]" id="description" placeholder="Enter description" rows="7"></textarea>
                                            </div>
                                        </td>
                                        <td class="project-actions text-right">
                                           
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Create</button>
                            <button type="button" class="btn btn-success float-right" id="btn-add-row">
                                <i class="fas fa-plus-circle"></i>
                            </button>
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
    var addNewRow = `<tr>
                        <td>
                            #
                        </td>
                        <td>
                            <div class='form-group row'>
                                <input type='file' name='files[]' class='form-control dropify'>
                            </div>
                        </td>
                        <td>
                            <div class='form-group'>
                                <textarea class='form-control' name='names[]' id='name' placeholder='Enter name' rows='7'></textarea>
                            </div>
                        </td>
                        <td>
                            <div class='form-group'>
                                <textarea class='form-control' name='descriptions[]' id='description' placeholder='Enter description' rows='7'></textarea>
                            </div>
                        </td>
                        <td class='project-actions text-right'>
                            <a class='btn btn-danger btn-sm btn-remove-row' href='#'>
                                <i class='fas fa-trash'>
                                </i>
                            </a>
                        </td>
                    </tr>`;
    $('.dropify').dropify();
    $("#btn-add-row").click(function() {
        $("#tcontent").append(addNewRow);
        $('.dropify').dropify();
    });

    $("body").on("click", ".btn-remove-row", function(){
        $(this).closest("tr").remove();
    });
</script>
@endsection
