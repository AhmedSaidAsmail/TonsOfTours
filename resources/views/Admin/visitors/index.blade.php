@extends('Admin.Layouts._master')
@section ('Extra_Css')
    <link rel="stylesheet" href="{{asset('admin_resources/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
    <style>
        .remove-button {
            border: none;
            background-color: transparent;
            padding: 0;
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1> Web visitors
                <small>Visitors tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
                <li><a href="#">Visitors</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- box -->
                    <div class="box">
                        <div class="box-header with-border">
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
                            @endif
                            {{-- Alerts Messages / Ending --}}
                        </div>

                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Web Visitors Data With Full Features</h3>
                        </div>
                        <div class="box-body">
                            <table id="dataTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Ip</th>
                                    <th>Last Visit</th>
                                    <th>#Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($visitors as $visitor)
                                    <tr>
                                        <td>{{$visitor->country}}</td>
                                        <td>{{$visitor->state}}</td>
                                        <td>{{$visitor->city}}</td>
                                        <td>{{$visitor->ip}}</td>
                                        <td>{{$visitor->last_visit}}</td>
                                        <td>
                                            <form method="post"
                                                  action="{{route('site-visitor.destroy',['id'=>$visitor->id])}}"
                                                  id="itemDelete">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                            <ul class="list-inline">
                                                <li>
                                                    <a href="{{route('site-visitor.show',['id'=>$visitor->id])}}">
                                                        <i class="fa fa-search"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="remove-button" form="itemDelete">
                                                        <i class="fa fa-trash-o fa-lg text-danger"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Country</th>
                                    <th>State</th>
                                    <th>City</th>
                                    <th>Ip</th>
                                    <th>Last Visit</th>
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
            $("#example1").DataTable();
            $('#dataTable').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "order": [[4, 'desc']],
                "info": true,
                "autoWidth": false
            });
        });
    </script>
@endsection