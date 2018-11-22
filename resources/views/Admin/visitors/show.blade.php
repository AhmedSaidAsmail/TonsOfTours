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
                            <h3 class="box-title">Web Visitors IP: {{$visitor->ip}}</h3>
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
                        <div class="box-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Url</th>
                                    <th>Title</th>
                                    <th>Visit Time</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($visitor->pages as $page)
                                    <tr>
                                        <td><a href="{{$page->url}}" target="_blank">{{str_limit($page->url,50,'...')}}</a></td>
                                        <td>{{$page->title}}</td>
                                        <td>{{$page->created_at}}</td>
                                    </tr>
                                @endforeach

                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Url</th>
                                    <th>Title</th>
                                    <th>Visit Time</th>
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