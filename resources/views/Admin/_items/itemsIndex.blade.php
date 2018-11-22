@extends('Admin.Layouts._master')
@section('title','Items Panel')
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
            <h1> Items
                <small>Items tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
                <li><a href="#">Items</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="form-group">
                                <a href="{{route('item.create')}}" class="btn btn-warning btn-block">
                                    <i class="fa fa-plus-square fa-lg"></i> Add New Items
                                </a>
                            </div>
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
                            <h3 class="box-title">Categories Data With Full Features</h3>
                        </div>
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>Recommended</th>
                                    <th>#Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($items as $item)
                                    <tr>
                                        <td>{{$item->category->name}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>
                                            <i class="fa fa-circle text-{!! $item->status?"green":"gray" !!}"></i>
                                        </td>
                                        <td>
                                            <i class="fa fa-circle text-{!! $item->recommended?"green":"gray" !!}"></i>
                                        </td>
                                        <td>
                                            <form method="post" action="{{route('item.destroy',['id'=>$item->id])}}"
                                                  id="itemDelete">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                            <ul class="list-inline text-center">
                                                <li>
                                                    <a href="{{route('item.edit',['id'=>$item->id])}}">
                                                        <i class="fa fa-pencil-square fa-lg text-success"></i>
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
                                    <th>Category</th>
                                    <th>Item</th>
                                    <th>Status</th>
                                    <th>Recommended</th>
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