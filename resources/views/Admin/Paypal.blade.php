@extends('Admin.Layouts._master')
@section('title','Main Category Panel')
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1> PayPal  <small>Paypal settings</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel </a></li>
            <li><a href="#">Paypal settings</a></li>
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

                        @if(Session::has('errorMsg'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> {{Session('errorMsg')}} </h4>
                            ..<a href="#" id="errorDetails">Details</a>
                            {!! (Session::has('errorDetails'))?'<p id="ErrorMsgDetails">'.Session('errorDetails').'</p>':'' !!}
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
                        @endif
                    </div>
                    <div>
                        @if(count($paypal)>0)
                        <form method="post" action="{{route('Paypal.update',['id'=>$paypal->first()->id])}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Account ID:</label>
                                            <input class="form-control" value="{{$paypal->first()->acount_id}}" name="acount_id" placeholder="Enter Your Account ID" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Secret ID:</label>
                                            <input class="form-control" value="{{$paypal->first()->secret_id}}" name="secret_id" placeholder="Enter Your Secret ID" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Money Percentage %</label>
                                            <input type="number" class="form-control" value="{{$paypal->first()->pay_percentage}}" name="pay_percentage" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group"> <button class="btn btn-primary btn-block"><i class="fa fa-paypal"></i> Update Paypal Seetings</button>
                                </div>
                                <div class="form-group"> </div>
                            </div>
                        </form>
                        <form method="post" action="{{route('Paypal.destroy',['id'=>$paypal->first()->id])}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <button class="btn btn-danger btn-block"><i class="fa fa-paypal"></i> Delete Paypal Seeting</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                        <form method="post" action="{{route('Paypal.store')}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label> Account ID:</label>
                                            <input class="form-control" name="acount_id" placeholder="Enter Your Account ID" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Secret ID:</label>
                                            <input class="form-control" name="secret_id" placeholder="Enter Your Secret ID" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Money Percentage %</label>
                                            <input type="number" class="form-control" name="pay_percentage" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group"> <button class="btn btn-primary btn-block"><i class="fa fa-paypal"></i> Add New Paypal Seetings</button>
                                </div>
                                <div class="form-group"> </div>
                            </div>
                        </form>

                        @endif
                    </div>
                </div>
                <!-- end box 1 -->
                <!-- /.box -->

                <!-- /.box -->
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