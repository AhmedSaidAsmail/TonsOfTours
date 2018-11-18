@extends('Admin.Layouts._master')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>Items <small>Items Update {{$Item->name}}</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Items  : {{$Item->name}}</a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">

        <div class="box">
            <div class="box-header with-border"><h4><a href="#">Add New</a> {{ucfirst($modelName)}}</h4></div>
            <form method="post" action="{{route('Information.store',['itemID'=>$Item->id])}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="modelName" value="{{$modelName}}">
                <div class="box-body">
                    <div id="text-group">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input class="form-control" name="text[]" value="" placeholder="Text" required>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <a class=" btn btn-default" id="deleteRow"><i class="fa fa-fw fa-trash-o"></i></a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <a class="btn btn-success" id="addRow"><i class="fa fa-fw fa-plus"></i>Add Text</a>
                                <input class="btn btn-primary" type="submit" value="Insert">
                            </div>
                        </div>

                    </div>
                </div>
            </form>
        </div>


    </section>
    <!--end content -->
</div>
@endsection
@section('Extra_Js')
<script src="{{asset('js/admin/admin.js')}}"></script>

@endsection