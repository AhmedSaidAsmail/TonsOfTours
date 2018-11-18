@extends('Admin.Layouts._master')
@section('title','Items Panel')
@section ('Extra_Css')

<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/lib/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/lib/css/prettify.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/src/bootstrap-wysihtml5.css')}}" />


@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1> Topics <small>Topics tables</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Items</a></li>
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
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-default" id="addNew"><i class="fa fa-database"></i> Update {{ $topic->name }}</button>
                        </div>

                        @if(count($errors)>0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>

                        @endif
                    </div>
                    <div id="basicToggle">
                        <form method="post" action="{{route('Topics.update',['id'=>$topic->id])}}" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="PUT">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item Name:</label>
                                            <input class="form-control" name="name" value="{{ $topic->name }}" placeholder="Main category Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Item Title:</label>
                                            <input class="form-control" name="title" value="{{ $topic->title }}" placeholder="Main category Title" required>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Icon</label>
                                            <select class="form-control" name="icon">
                                                <option value="">Select Icon</option>
                                                <option value="glyphicon-question-sign" {!! ($topic->icon=='glyphicon-question-sign')?'selected="selected"':'' !!}>Question mark</option>
                                                <option value="glyphicon-earphone" {!! ($topic->icon=='glyphicon-earphone')?'selected="selected"':'' !!}>earphone</option>
                                                <option value="glyphicon-pushpin" {!! ($topic->icon=='glyphicon-pushpin')?'selected="selected"':'' !!}>pushpin</option>
                                                <option value="glyphicon-map-marker" {!! ($topic->icon=='glyphicon-map-marker')?'selected="selected"':'' !!}>map marker</option>
                                                <option value="glyphicon-star" {!! ($topic->icon=='glyphicon-star')?'selected="selected"':'' !!}>star</option>
                                                <option value="glyphicon-heart" {!! ($topic->icon=='glyphicon-heart')?'selected="selected"':'' !!}>heart</option>
                                                <option value="glyphicon-search" {!! ($topic->icon=='glyphicon-search')?'selected="selected"':'' !!}>search</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label>Arrangement:</label>
                                            <input type="number" value="{{ $topic->arrangement }}" class="form-control" name="arrangement">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Top</label>
                                            <select class="form-control" name="top">

                                                <option value="1">True</option>
                                                <option value="0" {!! (!$topic->top)?'selected="selected"':'' !!}>False</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Footer</label>
                                            <select class="form-control" name="footer">

                                                <option value="1">True</option>
                                                <option value="0" {!! (!$topic->footer)?'selected="selected"':'' !!}>False</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Side Bar</label>
                                            <select class="form-control" name="sidebar">

                                                <option value="1">True</option>
                                                <option value="0" {!! (!$topic->sidebar)?'selected="selected"':'' !!}>False</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Top Link Name:</label>
                                            <input class="form-control" value="{{ $topic->top_link }}" name="top_link" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Footer Link Name:</label>
                                            <input class="form-control" value="{{ $topic->footer_link }}" name="footer_link" >
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>side Bar Link Name:</label>
                                            <input class="form-control" value="{{ $topic->sidebar_link }}" name="sidebar_link">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keywords:</label>
                                            <input class="form-control" name="keywords" value="{{ $topic->keywords }}" placeholder="-- Keywords --" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description:</label>
                                            <input class="form-control" name="description" value="{{ $topic->description }}" placeholder="-- Description --" >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group"> <input type="submit" class="btn btn-primary" value="Update Topic"></div>
                                <div class="form-group"> </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end box 1 -->

            </div>
        </div>


        @if(Session::has('updateArticles'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Alert!</h4>
            {{Session('updateArticles')}}
        </div>
        @endif
        <?php $Topics_text = $topic->Topics_text; ?>
        @if(!is_null($Topics_text))
        <form action="{{ route('Articles.update',['id'=>$Topics_text->id]) }}" method="post">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-info">
                        <div class="box-header">
                            <h3 class="box-title">Topic Articles
                                <small>Update Articles</small>
                            </h3>
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                                    <i class="fa fa-times"></i></button>
                            </div>
                            <!-- /. tools -->
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body pad">

                            <textarea class="textarea" name="txt" placeholder="Enter text ..." style="width: 810px; height: 200px">
                         {{$Topics_text->txt}}
                            </textarea>


                            <div class="form-group">
                                <button class="btn btn-primary btn-block">Update</button>
                            </div>

                            <div class="form-group">
                                <a href="{{ route('Gallery.index',[$topic->id]) }}" class="btn btn-default btn-block">Images</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endif







    </section>
</div>
@endsection
@section('Extra_Js')
<script src="{{asset('js/admin/admin.js')}}"></script>
<script src="{{asset('css/admin/TextEditor/lib/js/wysihtml5-0.3.0.js')}}"></script>
<script src="{{asset('css/admin/TextEditor/lib/js/prettify.js')}}"></script>
<script src="{{asset('css/admin/TextEditor/lib/js/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('css/admin/TextEditor/src/bootstrap-wysihtml5.js')}}"></script>


<script>
$('.textarea').wysihtml5({
    "stylesheets": ["{{asset('css/admin/TextEditor/lib/css/wysiwyg-color.css')}}", "{{asset('css/admin/TextEditor/lib/css/highlight/github.css')}}"],
    "color": true,
    "size": 'small',
    "html": true,
    "format-code": true
});
</script>
@endsection



