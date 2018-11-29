@extends('Admin.Layouts._master')
@section('title','Items Panel')
@section ('Extra_Css')
    <link rel="stylesheet" href="{{asset('admin_resources/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <!-- Directory&Header -->
        <section class="content-header">
            <h1> Reservations
                <small>Archive tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
                <li><a href="#">Reservations</a></li>
            </ol>
        </section>
        <!-- end Directory&Header -->
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- box -->

                    <!-- end box 1 -->
                    <!-- /.box -->
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Reservations Archive Data With Full Features</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Tours</th>
                                    <th>Total</th>
                                    <th>Deposit</th>
                                    <th>Approval</th>
                                    <th>#Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($reservations as $reservation)
                                    <tr>
                                        <td>{{date('M d, Y',strtotime($reservation->date))}}</td>
                                        <td>{{$reservation->customer->name}}</td>
                                        <td>{{$reservation->customer->email}}</td>
                                        <td>{{$reservation->items->count()}}</td>
                                        <td>{{$reservation->total}}</td>
                                        <td>{{$reservation->deposit}}</td>
                                        <td>
                                            <i class="fa fa-circle {!! ($reservation->approval)? 'text-green':'text-gray' !!}"></i>
                                        </td>
                                        <td>
                                            <ul class="list-inline">
                                                <li>
                                                    <a href="{{route('reservation.show',['id'=>$reservation->id])}}">
                                                        <i class="fa fa-search fa-lg text-primary"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Tours</th>
                                    <th>Total</th>
                                    <th>Deposit</th>
                                    <th>Approval</th>
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
            $("#dataTable").DataTable({
                "order": [[0, "desc"]]
            });
        });
    </script>
@endsection

