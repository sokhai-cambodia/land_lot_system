
<section class="content-header">
    <div class="container-fluid">
        @if(isset($contentHeaders))
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $title ?? 'Header Name' }}</h1>
                </div>
                <div class="col-sm-12">
                    <ol class="breadcrumb float-sm-right">
                        @foreach ($contentHeaders as $contentHeader)
                            @if($contentHeader['class'] != 'active')
                                <li class="breadcrumb-item"><a href="{{ UtilHelper::route($contentHeader['route']) }}">{{ $contentHeader['name'] }}</a></li>    
                            @else
                                <li class="breadcrumb-item active">{{ $contentHeader['name'] }}</li>
                            @endif
                        @endforeach
                    </ol>
                </div>
            </div>
        @endif
    </div>
    <!-- /.container-fluid -->
</section>