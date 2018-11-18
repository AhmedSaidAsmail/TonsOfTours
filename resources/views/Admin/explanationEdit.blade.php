@extends('Admin.Layouts._master')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
<link rel="stylesheet" href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/lib/css/bootstrap.min.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/lib/css/prettify.css')}}" />
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/src/bootstrap-wysihtml5.css')}}" />
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>Items <small>Explanation</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Items :{{ App\MyModels\Admin\Item::find($itemID)->name }} </a></li>
        </ol>
    </section>

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
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-android"></i> Add Explanation</a></h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{ route('Exploration.update',['itemID'=>$itemID,'id'=>$item->id]) }}" enctype="multipart/form-data">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" value="{{ csrf_token() }}" name="_token">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Text</label>

                                    <textarea class="textarea" name="txt" placeholder="Enter text ..." style="width: 810px; height: 200px">{{ $item->txt }}</textarea>
                                </div>

                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    <a href="{{ route('Exploration.index',['item'=>$itemID]) }}" class="btn btn-bitbucket"><i class="fa fa-dashboard"></i> Return Back to Explanation List</a>
                                    <button class="btn btn-primary"><i class="fa fa-paw"></i> Update Exploration</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- end content -->
</div>
@endsection
@section('Extra_Js')
<script src="{{asset('js/admin/admin.js')}}"></script>
<script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
<script src="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('css/admin/TextEditor/lib/js/wysihtml5-0.3.0.js')}}"></script>
<script src="{{asset('css/admin/TextEditor/lib/js/prettify.js')}}"></script>
<script src="{{asset('css/admin/TextEditor/lib/js/highlight/highlight.pack.js')}}"></script>
<script src="{{asset('css/admin/TextEditor/src/bootstrap-wysihtml5.js')}}"></script>
<script>
$(function() {
    $(".select2").select2();
    $(".timepicker").timepicker({
        showInputs: false,
        showMeridian: false
    });
});
$('.textarea').wysihtml5({
    "stylesheets": ["{{asset('css/admin/TextEditor/lib/css/wysiwyg-color.css')}}", "{{asset('css/admin/TextEditor/lib/css/highlight/github.css')}}"],
    "color": true,
    "size": 'small',
    "html": true,
    "format-code": true
});
</script>
@endsection
