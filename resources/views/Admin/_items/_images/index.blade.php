@extends('Admin.Layouts._master')
@section('title','Items Panel')
@section ('Extra_Css')
    <link rel="stylesheet" href="{{asset('admin_resources/plugins/datatables/dataTables.bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
    <style>
        .image-thumb {
            position: relative;
            width: 80px;
            height: 80px;
            overflow: hidden;
            background-color: #ffffff;
            border: 1px solid #000000;
        }

        .image-thumb > img {
            position: absolute;
            height: 100%;
            top: -9999px;
            bottom: -9999px;
            left: -9999px;
            right: -9999px;
            margin: auto;
        }

        .image-thumb > input[type=checkbox] {
            position: absolute;
            top: 0;
            left: 3px;
            transform: scale(1.5);
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1> Items
                <small>Items Images</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
                <li><a href="#">Images</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <!-- box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="form-group">
                                <a href="{{route('images.create')}}" class="btn btn-warning btn-block">
                                    <i class="fa fa-plus-square fa-lg"></i> Upload new Images
                                </a>
                            </div>
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
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th class="text-right">#Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($images as $image)
                                    <tr>
                                        <td>
                                            <div class="image-thumb">
                                                <img src="{{asset('images/gallery/thumb/'.$image->image)}}">
                                                <input type="checkbox" name="images[{{$image->id}}]" value="{{$image->image}}"
                                                       form="destroyForm">
                                            </div>
                                        </td>
                                        <td>
                                            {{$image->title}}
                                        </td>
                                        <td class="text-right">
                                            <a>
                                                <i class="fa fa-pencil-square fa-2x"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th class="text-right">#Action</th>
                                </tr>
                                </tfoot>
                            </table>
                            <form method="post" action="{{route('images.destroy')}}" id="destroyForm">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger btn-block">
                                    <i class="fa fa-trash fa-2x"></i>
                                </button>
                            </form>
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