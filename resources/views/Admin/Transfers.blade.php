@extends('Admin.Layouts._master')
@section('title','Items Panel')
@section ('Extra_Css')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1> Topics <small>Transfers tables</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Transfers</a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <!-- box -->
                <div class="box">
                    <div class="box-header with-border">
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-default" id="addNew"><i class="fa fa-database"></i> Add New Transfer</button>
                        </div>
                        @if(Session::has('addStatus'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            {{Session('addStatus')}}
                        </div>
                        @elseif(Session::has('errorDetails'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            {{Session('errorDetails')}}
                        </div>
                        @elseif(count($errors)>0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @elseif(Session::has('deleteStatus'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            {{Session('deleteStatus')}}
                        </div>
                        @elseif(Session::has('fetchData'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-check"></i> Alert!</h4>
                            {{Session('fetchData')}}
                        </div>
                        @endif
                    </div>
                    <div id="basicToggle">
                        <form method="post" action="{{route('Transfers.store')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Transfers From:</label>
                                            <input class="form-control" name="dist_from" placeholder="Enter Distantion From" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Transfer To:</label>
                                            <input class="form-control" name="dist_to" placeholder="Enter Distantion To" required>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Limousine</label>
                                            <input type="number" class="form-control" value="0" name="type_limousine">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Van</label>
                                            <input type="number" class="form-control" value="0" name="type_van">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Coaster</label>
                                            <input type="number" class="form-control" value="0" name="type_coaster">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Bus</label>
                                            <input type="number" class="form-control" value="0" name="type_bus">
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group"> <input type="submit" class="btn btn-primary" value="Add New Tranfer"></div>
                                <div class="form-group"> </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end box 1 -->
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Transfers Data With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Limousine</th>
                                    <th>Van</th>
                                    <th>Coaster</th>
                                    <th>Bus</th>
                                    <th>#Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($transfers as $transfer)
                                <tr>
                                    <td>{{$transfer->dist_from}}</td>
                                    <td>{{$transfer->dist_to}}</td>
                                    <td>{{$transfer->type_limousine}}</td>
                                    <td>{{$transfer->type_van}}</td>
                                    <td>{{$transfer->type_coaster}}</td>
                                    <td>{{$transfer->type_bus}}</td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</                                                            span> </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{route('Transfers.edit',['id'=>$transfer->id])}}">Change</a></li>

                                                <form action="{{route('Transfers.destroy',['id'=>$transfer->id])}}" method="post">
                                                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <li><a class="deleteItem list-group-item" href="#" title="{{$transfer->id}}">Delete</a></li>
                                                </form>
                                            </ul>
                                        </div></td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>From</th>
                                    <th>To</th>
                                    <th>Limousine</th>
                                    <th>Van</th>
                                    <th>Coaster</th>
                                    <th>Bus</th>
                                    <th>#Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('Extra_Js')
<script src="{{asset('js/admin/admin.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
$(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false
    });
});
</script>
@endsection

