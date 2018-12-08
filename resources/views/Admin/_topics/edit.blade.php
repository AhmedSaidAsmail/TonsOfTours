@extends('Admin.Layouts._master')
@section('title','Items Panel')
@section ('Extra_Css')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
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
                            Add New Topic
                        </div>
                        <div class="box-body">
                            <form method="post" action="{{route('topics.update',['id'=>$topic->id])}}"
                                  enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PUT">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Topic Name:
                                                    <small>not allowed with spaces</small>
                                                </label>
                                                <input class="form-control" name="name" value="{{$topic->name}}"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Topic Title:</label>
                                                <input class="form-control" name="title" value="{{$topic->title}}"
                                                       required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Icon</label>
                                                <select class="form-control" name="icon">
                                                    <option value="">Select Icon</option>
                                                    <option value="glyphicon-question-sign" {!! ($topic->icon=='glyphicon-question-sign')?'selected="selected"':'' !!}>
                                                        Question mark
                                                    </option>
                                                    <option value="glyphicon-earphone" {!! ($topic->icon=='glyphicon-earphone')?'selected="selected"':'' !!}>
                                                        earphone
                                                    </option>
                                                    <option value="glyphicon-pushpin" {!! ($topic->icon=='glyphicon-pushpin')?'selected="selected"':'' !!}>
                                                        pushpin
                                                    </option>
                                                    <option value="glyphicon-map-marker" {!! ($topic->icon=='glyphicon-map-marker')?'selected="selected"':'' !!}>
                                                        map marker
                                                    </option>
                                                    <option value="glyphicon-star" {!! ($topic->icon=='glyphicon-star')?'selected="selected"':'' !!}>
                                                        star
                                                    </option>
                                                    <option value="glyphicon-heart" {!! ($topic->icon=='glyphicon-heart')?'selected="selected"':'' !!}>
                                                        heart
                                                    </option>
                                                    <option value="glyphicon-search" {!! ($topic->icon=='glyphicon-search')?'selected="selected"':'' !!}>
                                                        search
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Arrangement:</label>
                                                <input type="number" value="0" class="form-control" name="arrangement">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Top</label>
                                                <select class="form-control" name="top">
                                                    <option value="1">True</option>
                                                    <option value="0" {!! (!$topic->top)?'selected="selected"':'' !!}>
                                                        False
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Footer</label>
                                                <select class="form-control" name="footer">
                                                    <option value="1">True</option>
                                                    <option value="0" {!! (!$topic->footer)?'selected="selected"':'' !!}>
                                                        False
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Top Link Name:</label>
                                                <input class="form-control" name="top_link"
                                                       value="{{ $topic->top_link }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Footer Link Name:</label>
                                                <input class="form-control" name="footer_link"
                                                       value="{{ $topic->footer_link }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Keywords:</label>
                                                <input class="form-control" name="keywords"
                                                       value="{{ $topic->keywords }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <input class="form-control" name="description"
                                                       value="{{ $topic->description }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Text</label>
                                                <textarea id="summernote" name="txt">{{ $topic->txt }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-success">
                                            <i class="fa fa-pencil"></i> Update {{$topic->name}}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('Extra_Js')
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script>
        $(function () {
            $('#summernote').summernote();
        });
    </script>
@endsection

