<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
    <link rel="stylesheet" href="{{ asset('/vendor/dropzoneWithDropbox/custom.css')}}">
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-head">
                        <div class="card-header border-bottom  search-filter-header">
                            <h4 class="card-title"><i class="fa fa-list-alt"></i> Dropzone Upload</h4>
                            <div class="heading-elements text-right">
                                <div class="btn-group">
                                    <a href="{{url('image/index')}}" class="btn btn-primary btn-sm waves-effect waves-light" title="Upload"><i class="fa fa-arrow-left"></i> Go to List </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form method="post" action="{{url('image/upload/store')}}" enctype="multipart/form-data" class="dropzone" id="dropzone">
                            @csrf
                            </form> 
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div>
    <script type="text/javascript">
        var filelist = '{{ route("image/index") }}';
    </script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script>
    <script src="{{ asset('/vendor/dropzoneWithDropbox/imageupload.js')}}" type="text/javascript"></script>
</body>
</html>