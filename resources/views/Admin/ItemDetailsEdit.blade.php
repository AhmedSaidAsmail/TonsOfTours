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
            <div class="box-header"><h4>Update {{ucfirst($modelName )}} No:{{$Data->id}}</h4></div>
            <form method="post" action="{{route('Information.update',['itemID'=>$Item->id,'rowID'=>$Data->id])}}">
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="modelName" value="{{$modelName}}">
                <div class="box-body">
                    <div id="text-group">
                        <div class="row">
                            <div class="col-md-11">
                                <div class="form-group">
                                    <input class="form-control" name="text" value="{{$Data->txt}}" placeholder="Text" required>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <input class="form-control btn btn-primary" type="submit" value="Update">
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