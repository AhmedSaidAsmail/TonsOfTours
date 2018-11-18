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
            <div class="box-header with-border">
                <h4><a href="">Delete Details  </a>{{$modelName }} no:{{$rowID}}</h4></div>
            <form method="post" action="{{route('Information.destroy',['item'=>$Item->id,'rowID'=>$rowID])}}">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <input type="hidden" name="modelName" value="{{$modelName}}">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete </button>
                                <a href="{{route('Items.edit',['Items'=>$Item->id])}}" class="btn btn-warning"><i class="fa fa-ban"></i> Cancel</a>
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