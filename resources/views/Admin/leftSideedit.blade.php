@extends('Admin.Layouts._master')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>Left Side <small>Icons</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Icons  </a></li>
        </ol>
    </section>

    @if(count($errors)>0)
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-android"></i> Edit Icons</a></h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('leftsSide.update',['id'=>$item->id]) }}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" name="name" value="{{ $item->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="img">
                                </div>

                                <div class="form-group">
                                    <label>Link</label>
                                    <textarea class="form-control" name="link">{{ $item->link }}</textarea>
                                </div>

                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('leftsSide.index') }}" class="btn btn-bitbucket"><i class="fa fa-dashboard"></i> Return Back to Icons List</a>
                                    <button class="btn btn-primary"><i class="fa fa-paw"></i> Update Icon</button>
                                </div>
                            </div>

                        </form>
                    </div>

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
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script>
$(function() {
    $(".select2").select2();
    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false
    });
});
</script>
@endsection
