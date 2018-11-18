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
        <h1> Topics <small>Topics tables</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Items</a></li>
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
                            <button type="submit" class="form-control btn btn-default" id="addNew"><i class="fa fa-database"></i> Add New Topic</button>
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
                        <form method="post" action="{{route('Topics.store')}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item Name:</label>
                                            <input class="form-control" name="name" placeholder="Main category Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item Title:</label>
                                            <input class="form-control" name="title" placeholder="Main category Title" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <select class="form-control" name="icon">
                                                <option value="">Select Icon</option>
                                                <option value="glyphicon-question-sign">Question mark</option>
                                                <option value="glyphicon-earphone">earphone</option>
                                                <option value="glyphicon-pushpin">pushpin</option>
                                                <option value="glyphicon-map-marker">map marker</option>
                                                <option value="glyphicon-star">star</option>
                                                <option value="glyphicon-heart">heart</option>
                                                <option value="glyphicon-search">search</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Arrangement:</label>
                                            <input type="number" value="0" class="form-control" name="arrangement">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Top</label>
                                            <select class="form-control" name="top">
                                                <option value="0">Select</option>
                                                <option value="1">True</option>
                                                <option value="0">False</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Footer</label>
                                            <select class="form-control" name="footer">
                                                <option value="0">Select</option>
                                                <option value="1">True</option>
                                                <option value="0">False</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Side Bar</label>
                                            <select class="form-control" name="sidebar">
                                                <option value="0">Select</option>
                                                <option value="1">True</option>
                                                <option value="0">False</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Top Link Name:</label>
                                            <input class="form-control" name="top_link" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Footer Link Name:</label>
                                            <input class="form-control" name="footer_link" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>side Bar Link Name:</label>
                                            <input class="form-control" name="sidebar_link">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keywords:</label>
                                            <input class="form-control" name="keywords" placeholder="-- Keywords --" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <input class="form-control" name="description" placeholder="-- Description --" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> <input type="submit" class="btn btn-primary" value="Add New Topics"></div>
                                <div class="form-group"> </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end box 1 -->
                <!-- /.box -->
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Topics Data With Full Features</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Topic Name</th>
                                    <th>Title</th>
                                    <th>Top</th>
                                    <th>Footer</th>
                                    <th>Side</th>
                                    <th>#Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($data as $Item)
                                <tr>
                                    <td>{{$Item->name}}</td>
                                    <td>{{$Item->title}}</td>
                                    <td>{!! $Item->top?'<i class="fa fa-circle text-green"></i>':'<i class="fa fa-circle text-gray"></i>' !!}</td>
                                    <td>{!! $Item->footer?'<i class="fa fa-circle text-green"></i>':'<i class="fa fa-circle text-gray"></i>' !!}</td>
                                    <td>{!! $Item->sidebar?'<i class="fa fa-circle text-green"></i>':'<i class="fa fa-circle text-gray"></i>' !!}</td>
                                    <td><div class="btn-group">
                                            <button type="button" class="btn btn-default">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</                                                            span> </button>
                                            <ul class="dropdown-menu" role="menu">
                                                <li><a href="{{route('Topics.edit',['topic'=>$Item->id])}}">Change</a></li>

                                                <li>
                                                    <form action="{{route('Topics.destroy',['id'=>$Item->id])}}" method="post">
                                                        <input type="hidden" name="_token" value="{{csrf_token()}}">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <a href="#" class="deleteItem list-group-item" title="{{$Item->name}}">Delete</a>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div></td>
                                </tr>
                                @endforeach
                            </tbody>

                            <tfoot>
                                <tr>
                                    <th>Topic Name</th>
                                    <th>Title</th>
                                    <th>Top</th>
                                    <th>Footer</th>
                                    <th>Side</th>
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
$(function () {
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

