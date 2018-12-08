@extends('Admin.Layouts._master')
@section('title','Items Panel')
@section ('Extra_Css')
    <link rel="stylesheet" href="{{asset('admin_resources/plugins/datatables/dataTables.bootstrap.css')}}">
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1> Topics
                <small>Topics tables</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
                <li><a href="#">Items</a></li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <div class="form-group">
                                <a class="btn btn-primary btn-block" href="{{route('topics.create')}}">
                                    Add New Topic
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Topics Data With Full Features</h3>
                        </div>
                        <div class="box-body">
                            <table id="topics" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Topic Name</th>
                                    <th>Title</th>
                                    <th>Top</th>
                                    <th>Footer</th>
                                    <th>#Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topics as $topic)
                                    <tr>
                                        <td>{{$topic->name}}</td>
                                        <td>{{$topic->title}}</td>
                                        <td>
                                            <i class="fa fa-circle {!! $topic->top?"text-green":"text-gray"!!}"></i>
                                        </td>
                                        <td>
                                            <i class="fa fa-circle {!! $topic->footer?"text-green":"text-gray"!!}"></i>
                                        </td>
                                        <td>
                                            <form action="{{route('topics.destroy',['id'=>$topic->id])}}"
                                                  id="deletingForm" method="post">
                                                {{csrf_field()}}
                                                <input type="hidden" name="_method" value="DELETE">
                                            </form>
                                            <ul class="list-inline">
                                                <li>
                                                    <a href="{{route('topics.edit',['topic'=>$topic->id])}}">
                                                        <i class="fa fa-pencil-square text-warning"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="remove-button" form="deletingForm">
                                                        <i class="fa fa-trash text-danger"></i>
                                                    </button>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Topic Name</th>
                                    <th>Title</th>
                                    <th>Top</th>
                                    <th>Footer</th>
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(function () {
            $("#topics").DataTable();
            $('#summernote').summernote();
        });
    </script>
@endsection

