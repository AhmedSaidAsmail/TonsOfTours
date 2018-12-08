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
                            <form method="post" action="{{route('topics.store')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Topic Name:
                                                    <small>not allowed with spaces</small>
                                                </label>
                                                <input class="form-control" name="name" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Topic Title:</label>
                                                <input class="form-control" name="title" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label>Icon</label>
                                                <select class="form-control" name="icon">
                                                    <option value="">Select Icon</option>
                                                    <option value="glyphicon-question-sign">Question mark</option>
                                                    <option value="glyphicon-earphone">earphone</option>
                                                    <option value="glyphicon-pushpin">pushpin</option>
                                                    <option value="glyphicon-map-marker">map marker</option>
                                                    <option value="glyphicon-star">star</option>
                                                    <option value="glyphicon-heart">heart</option>
                                                    <option value="glyphicon-search">search</option>
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
                                                    <option value="0">Select</option>
                                                    <option value="1">True</option>
                                                    <option value="0">False</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Footer</label>
                                                <select class="form-control" name="footer">
                                                    <option value="0">Select</option>
                                                    <option value="1">True</option>
                                                    <option value="0">False</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Top Link Name:</label>
                                                <input class="form-control" name="top_link">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Footer Link Name:</label>
                                                <input class="form-control" name="footer_link">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Keywords:</label>
                                                <input class="form-control" name="keywords"
                                                       placeholder="-- Keywords --">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Description:</label>
                                                <input class="form-control" name="description"
                                                       placeholder="-- Description --">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Text</label>
                                                <textarea id="summernote" name="txt"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" class="btn btn-primary" value="Add New Topics">
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

