@extends('Admin.Layouts._master')
@section('title','Main Category Panel')
@section ('Extra_Css')
    <link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1> Main Categories
                <small>Main Category tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel </a></li>
                <li><a href="#">Main Categories</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-default" id="addNew">
                                    <i class="fa fa-code"></i> Add New MainCategory
                                </button>
                            </div>
                            {{-- Alerts Messages --}}
                            @if(Session::has('alert'))
                                <div class="alert {{Session('alertType')}} alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4><i class="icon fa fa-ban"></i> {{Session('alert')}} </h4>
                                    @if(Session::has('alertDetails'))
                                        ..<a href="#" id="errorDetails">Details</a>
                                        <p id="ErrorMsgDetails">{{Session('alertDetails')}}</p>
                                    @endif
                                </div>
                            @elseif(count($errors)>0)
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                                        &times;
                                    </button>
                                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{-- Alerts Messages / Ending --}}
                        </div>
                        {{-- Adding new from --}}
                        <div id="basicToggle">
                            <form method="post" action="{{route('mainCategory.store')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Main Category Name:</label>
                                                <input class="form-control" name="name" placeholder="Main category Name"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Main Category Title:</label>
                                                <input class="form-control" name="title"
                                                       placeholder="Main category Title" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="1">Show</option>
                                                    <option value="0">Hidden</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Home Shortcut</label>
                                                <select class="form-control" name="home">
                                                    <option value="1">Show</option>
                                                    <option value="0">Hidden</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Icon</label>
                                                <select name="icon" class="form-control">
                                                    <option value="">Select</option>
                                                    <option value="fa-university"> university</option>
                                                    <option value="fa-eye"> eye</option>
                                                    <option value="fa-anchor"> anchor</option>
                                                    <option value="fa-sun-o"> sun</option>
                                                    <option value="fa-picture-o"> picture</option>
                                                    <option value="fa-heart"> heart</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Arrangement</label>
                                                <input value="0" name="arrangement" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input type="file" class="form-control" name="img">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Keywords:</label>
                                                <input class="form-control" name="keywords" placeholder="Meta Keywords">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <input class="form-control" name="description"
                                                       placeholder="Meta Description">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success">Add New Main Category</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{-- Adding new from / Ending--}}
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Main Categories Data With Full Features</h3>
                        </div>
                        <div class="box-body">
                            <table id="items" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Main Category</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Index</th>
                                    <th>#Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($mainCategories as $mainCategory)
                                    <tr>
                                        <td>{{$mainCategory->name}}</td>
                                        <td>{{$mainCategory->title}}</td>
                                        <td> {!! ($mainCategory->status)? '<i class="fa fa-circle text-green"></i>':'<i class="fa fa-circle text-gray"></i>' !!} </td>
                                        <td> {!! ($mainCategory->home)? '<i class="fa fa-circle text-green"></i>':'<i class="fa fa-circle text-gray"></i>' !!} </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default">Action</button>
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown"><span class="caret"></span> <span
                                                            class="sr-only">Toggle Dropdown</span></button>
                                                <div class="dropdown-menu list-group">
                                                    <a href="{{route('mainCategory.edit',['id'=>$mainCategory->id])}}"
                                                       class="list-group-item">Change</a>
                                                    <form action="{{route('mainCategory.destroy',['id'=>$mainCategory->id])}}"
                                                          method="post">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <a href="#" class="deleteItem list-group-item"
                                                           title="{{$mainCategory->name}}">Delete</a>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Main Category</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Index</th>
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
            $("#items").DataTable();
        });
    </script>
@endsection