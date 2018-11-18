@extends('Admin.Layouts._master')
@section('title','Category Panel | Update')
@section ('Extra_Css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>Categories
                <small>Categories Update</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
                <li><a href="#">Update Category : {{$category->name}}</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="form-group">
                                <button type="submit" class="form-control btn-primary">
                                    Update Category : ({{$category->name}})
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
                        <form method="post" action="{{route('category.update',['id'=>$category->id])}}"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <input type="hidden" name="_method" value="PUT">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Main Category Name:</label>
                                            <select class="form-control" name="main_category_id">
                                                <option value="">Select Main Category</option>
                                                @foreach (mainCategoriesAll() as $mainCategory)
                                                    <option value="{{$mainCategory->id}}" {!!($mainCategory->id==$category->main_category_id)?'selected':''!!}>
                                                        {{$mainCategory->name}}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category Name:</label>
                                            <input class="form-control" value="{{$category->name}}" name="name"
                                                   placeholder="Category Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category Title:</label>
                                            <input class="form-control" value="{{$category->title}}" name="title"
                                                   placeholder="Category Title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1">Show</option>
                                                <option value="0" {!! (! $category->status)?'selected':'' !!}>
                                                    Hidden
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Home Shortcut</label>

                                            <select class="form-control" name="recommended">
                                                <option value="1">Show</option>
                                                <option value="0" {!! (! $category->recommended)?'selected':'' !!}>
                                                    Hidden
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Arrangement</label>
                                            <input value="{{$category->arrangement}}" name="arrangement"
                                                   class="form-control">
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
                                            <input class="form-control" value="{{$category->keywords}}" name="keywords"
                                                   placeholder="-- Keywords --">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <input class="form-control" value="{{$category->description}}"
                                                   name="description" placeholder="-- Description --">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-warning">Update {{$category->name}}</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- end content -->
    </div>
@endsection
@section('Extra_Js')
    <script src="{{asset('js/admin/admin.js')}}"></script>
@endsection