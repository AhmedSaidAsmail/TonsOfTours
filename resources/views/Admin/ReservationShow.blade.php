@extends('Admin.Layouts._master')
@section('title','Items Panel')
@section ('Extra_Css')
<link rel="stylesheet" href="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1> Reservations <small>Reservations Details</small> </h1>
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
                        Reservation Details
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">Name:</div>
                            <div class="col-md-4">{{$reservation->f_name}} {{$reservation->sur_name}}  </div>
                            <div class="col-md-2">Email:</div>
                            <div class="col-md-4">{{$reservation->email}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Hotel:</div>
                            <div class="col-md-4">{{$reservation->hotel}}</div>
                            <div class="col-md-2">Mobile:</div>
                            <div class="col-md-4">{{$reservation->mobile}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Date:</div>
                            <div class="col-md-10">{{$reservation->date}}</div>

                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                Arrival Flight No:
                            </div>
                            <div class="col-md-4">
                                {{$reservation->arrival_flight_no}}
                            </div>
                            <div class="col-md-2">
                                Arrival Flight Time:
                            </div>
                            <div class="col-md-4">
                                {{$reservation->arrival_flight_time}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                Departure Flight No:
                            </div>
                            <div class="col-md-4">
                                {{$reservation->departure_flight_no}}
                            </div>
                            <div class="col-md-2">
                                Departure Flight Time:
                            </div>
                            <div class="col-md-4">
                                {{$reservation->departure_flight_time}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Tours:</div>
                            <div class="col-md-4">{{$reservation->tours}}</div>
                            <div class="col-md-2">Transfers:</div>
                            <div class="col-md-4">{{$reservation->transfers}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Total:</div>
                            <div class="col-md-4">{{$reservation->total}}</div>
                            <div class="col-md-2">Deposit:</div>
                            <div class="col-md-4">{{$reservation->deposit}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Paid Status:</div>
                            <div class="col-md-4">
                                @if($reservation->paid)
                                Done
                                @else
                                Not Yet
                                @endif
                            </div>
                            <div class="col-md-2">Created at</div>
                            <div class="col-md-4">{{$reservation->created_at}}</div>
                        </div>
                        <div class="row" style="margin-top: 30px;">
                            <div class="col-md-12">
                                <a href="" class="btn btn-info btn-block"><i class="fa fa-mail-forward"></i>Send Email</a>
                            </div>
                        </div>
                    </div>
                </div>

                @if(count($reservation->selfTours)>0)
                @foreach($reservation->selfTours as $tour)
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{$tour->title}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Price:</div>
                            <div class="col-md-2">{{$tour->price}}</div>
                            <div class="col-md-2">Date:</div>
                            <div class="col-md-2">{{$tour->date}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">{{$tour->st_name}}</div>
                            <div class="col-md-2">{{$tour->st_no}}</div>
                            <div class="col-md-2">Price</div>
                            <div class="col-md-2">{{$tour->st_price}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">{{$tour->sec_name}}</div>
                            <div class="col-md-2">{{$tour->sec_no}}</div>
                            <div class="col-md-2">Price</div>
                            <div class="col-md-2">{{$tour->sec_price}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                @if(count($reservation->selfTransfers)>0)
                @foreach($reservation->selfTransfers as $transfer)
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3>{{$transfer->title}}</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Price:</div>
                            <div class="col-md-2">{{$transfer->price}}</div>
                            <div class="col-md-2">Arrival Date:</div>
                            <div class="col-md-2">{{$transfer->arrival_date}}</div>
                            <div class="col-md-2">Departure Date:</div>
                            <div class="col-md-2">{{$transfer->departure_date}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">From</div>
                            <div class="col-md-2">{{$transfer->dist_from}}</div>
                            <div class="col-md-2">To</div>
                            <div class="col-md-2">{{$transfer->dist_to}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Transfer Type</div>
                            <div class="col-md-2">{{$transfer->transfer_type}}</div>
                            <div class="col-md-2">Transfers Times</div>
                            <div class="col-md-2">{{$transfer->transfer_times}}</div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">Adult</div>
                            <div class="col-md-2">{{$transfer->adult}}</div>
                            <div class="col-md-2">Child</div>
                            <div class="col-md-2">{{$transfer->child}}</div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>
</div>
@endsection
@section('Extra_Js')
<script src="{{asset('js/admin/admin.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
<script>
$(function() {
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

