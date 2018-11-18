@extends('Admin.Layouts._master')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
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
                        <h3 class="box-title"><a href="#"><i class="fa fa-money"></i> Price List</a></h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('Price.update',['itemID'=>$itemID,'id'=>$price->id]) }}">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <input type='hidden' value="PUT" name="_method">
                            <div class="row margin-bottom">
                                <div class="form-group">
                                    <div class="col-md-3"><input class="form-control" type="text" value="{{ $price->st_name }}" name="st_name" placeholder="First Price Name"></div>
                                    <div class="col-md-3"><input class="form-control" type="text" value="{{ $price->st_price }}" name="st_price" placeholder="First Price"></div>
                                    <div class="col-md-3"><input class="form-control" type="text" value="{{ $price->sec_name }}" name="sec_name" placeholder="Second Price Name"></div>
                                    <div class="col-md-3"><input class="form-control" type="text" value="{{ $price->sec_price }}" name="sec_price" placeholder="Second Price"></div>
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
@endsection