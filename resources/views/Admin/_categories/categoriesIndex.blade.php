@extends('Admin.Layouts._master')
@section('title','Main Category Panel')
@section ('Extra_Css')
    <link rel="stylesheet" href="{{asset('admin_resources/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1> Categories
                <small>Categories tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
                <li><a href="#">Categories</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-default" id="addNew"><i
                                            class="fa fa-database"></i> Add New Category
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
                        <div id="basicToggle">
                            <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Main Category Name:</label>
                                                <select class="form-control" name="main_category_id">
                                                    <option value="">Select Main Category</option>
                                                    @foreach (mainCategoriesAll() as $mainCategory)
                                                        <option value="{{$mainCategory->id}}">{{$mainCategory->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category Name:</label>
                                                <input class="form-control" name="name" placeholder="Category Name"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Category Title:</label>
                                                <input class="form-control" name="title" placeholder="Category Title"
                                                       required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="1">Show</option>
                                                    <option value="0">Hidden</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Recommended</label>
                                                <select class="form-control" name="recommended">
                                                    <option value="1">Confirm</option>
                                                    <option value="0">Pause</option>
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
                                                <input class="form-control" name="keywords"
                                                       placeholder="-- Keywords --">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <input class="form-control" name="description"
                                                       placeholder="-- Description --">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success">Add New Category</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Categories Data With Full Features</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Main Category</th>
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Recommended</th>
                                    <th>#Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->mainCategory->name}}</td>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->title}}</td>
                                        <td>
                                            <i class="fa fa-circle text-{!! $category->status?"green":"grey" !!}"></i>
                                        </td>
                                        <td>
                                            <i class="fa fa-circle text-{!! $category->recommended?"green":"grey" !!}"></i>
                                        </td>
                                        <td>
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-default">Action</button>
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <div class="dropdown-menu list-group">
                                                    <a class="list-group-item"
                                                       href="{{route('category.edit',['id'=>$category->id])}}">Change</a>
                                                    <form action="{{route('category.destroy',['id'=>$category->id])}}"
                                                          method="post">
                                                        {{csrf_field()}}
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <a href="#" class="deleteItem list-group-item"
                                                           title="{{$category->name}}">Delete</a>
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
                                    <th>Category</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <th>Recommended</th>
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
    <script src="{{asset('admin_resources/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_resources/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
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