<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">

    <link href="{{ asset('/vendor/dropzoneWithDropbox/css/tables/datatable/datatables.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/vendor/dropzoneWithDropbox/css/tables/datatable/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-head">
                        <div class="card-header border-bottom  search-filter-header">
                            <h4 class="card-title"><i class="fa fa-list-alt"></i> Dropzone Image List</h4>
                            <div class="heading-elements text-right">
                                <div class="btn-group">
                                   <button type="button" class="btn btn-secondary dropdown-toggle btn-sm waves-effect waves-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="ft-settings"></i> Actions</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item delete_all" href="javascript:void(0);" data-url="{{ url('image/deleteall') }}" >Delete</a>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a href="{{url('image/upload')}}" class="btn btn-primary btn-sm waves-effect waves-light" title="Upload"><i class="fa fa-plus"></i> Upload </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form id="frmlist" name="frmlist" action="" class="form-horizontal" method="post">
                                <input type="hidden" id="token" class="form-control form-filter" name="_token" value="{{csrf_token()}}">
                                <table  class="table table-striped table-bordered table-hover" id="datatable_list" width="100%">
                                    <thead>
                                        <tr role="row" class="heading">
                                            <th><input type="checkbox" id="check_all"></th>
                                            <th class="img_datatable"> # </th>
                                            <th > File Name </th>
                                            <th > Actions </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </form> 
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
    </div> 

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var assets = '<?php echo url("/"); ?>'; 
    </script>
    <script src="{{ asset('/vendor/dropzoneWithDropbox/js/tables/datatable/datatables.min.js')}}"></script>

    <script src="{{ asset('/vendor/dropzoneWithDropbox/imageupload_list.js')}}" type="text/javascript"></script>
</body>
</html>