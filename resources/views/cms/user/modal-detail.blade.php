<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">{{ ucfirst($row->role) }} Detail</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <!-- Widget: user widget style 1 -->
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-info">
                        <h3 class="widget-user-username">{{ ucfirst($row->last_name) }} {{ ucfirst($row->first_name) }}</h3>
                        <h5 class="widget-user-desc">Role: {{ ucfirst($row->role) }}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle elevation-2" src="../dist/img/user1-128x128.jpg" alt="User Avatar">
                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">National ID: {{ $row->national_id }}</h5>
                                    <span class="description-text">Passport ID: {{ $row->passport_id }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 border-right">
                                <div class="description-block">
                                    <h5 class="description-header">Gender: {{ ucfirst($row->gender) }}</h5>
                                    <span class="description-text">Phone: {{ $row->phone }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">Status: {{ ucfirst($row->status) }}</h5>
                                    <span class="description-text">DOB: {{ $row->dob }}</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Document</h3>
                        <a href="{{ UtilHelper::route('document.user.create', ['userId' => $row->id]) }}" class="btn btn-outline-success btn-flat float-right">Upload</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Folder</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Extension</th>
                                    <th style="width: 40px">Size</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($docs) > 0)

                                    @php $no = 1 @endphp
                                    @foreach($docs as $doc)  
                                        @php $extension = FileHelper::getFileIcon($doc->extension) @endphp  
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $doc->folder }}</td>
                                            <td>{{ $doc->name }}</td>
                                            <td>{{ $doc->description }}</td>
                                            <td>
                                                <img src="{{ $extension }}" alt='{{ $doc->extension }}' style='width: 30px; height: 30px'/>
                                            </td>
                                            <td>{{ $doc->size }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="text-right"> 
                                            <a href="{{ UtilHelper::route('document.user', ['userId' => $row->id]) }}" >
                                                <i class="fas fa-angle-double-right"></i> View More
                                            </a>
                                        </td>
                                    </tr>
                                @else 
                                    <tr>
                                        <td colspan="6" class="text-center"> no document</td>
                                    </tr>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer float-right">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
</div>