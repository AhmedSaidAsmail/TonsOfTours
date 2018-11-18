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
        <h1>Items <small>Gallery</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Items :{{ App\MyModels\Admin\Item::find($itemID)->name }} </a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-android"></i> Gallery List</a></h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('Detail.update',['itemID'=>$itemID,'detail'=>$detail->id]) }}">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <input type='hidden' value="PUT" name="_method">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Started At:</label>
                                            <div class="input-group">
                                                <input type="text" name="started_at" value="{{ $detail->started_at}}" class="form-control timepicker">
                                                <div class="input-group-addon"> <i class="fa fa-clock-o"></i> </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <label>Ended At:</label>
                                            <div class="input-group">
                                                <input type="text" name="ended_at" value="{{ $detail->ended_at}}" class="form-control timepicker">
                                                <div class="input-group-addon"> <i class="fa fa-clock-o"></i> </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Availability</label>
                                        <select name="availability[]" class="form-control select2" multiple="multiple" data-placeholder="Select a Day">
                                            @foreach($week as $weekDay)
                                            <option {!! (in_array($weekDay,$days))?'selected="selected"':'' !!}>{{$weekDay}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ route('Items.edit',['item'=>$itemID]) }}" class="btn btn-bitbucket"><i class="fa fa-dashboard"></i> Return Back to Item Dashboard</a>
                                        <button class="btn btn-primary"><i class="fa fa-paw"></i> Update Details</button>
                                    </div>
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