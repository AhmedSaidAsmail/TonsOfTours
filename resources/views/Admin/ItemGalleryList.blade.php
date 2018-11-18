@extends('Admin.Layouts._master')
@section('title','Items Panel | Update')
@section ('Extra_Css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/style.css')}}">
@endsection
@section('content')
<div class="content-wrapper">
    <!-- Directory&Header -->
    <section class="content-header">
        <h1>Items <small>Gallery</small> </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> C-Panel</a></li>
            <li><a href="#">Update Items :{{ App\MyModels\Admin\Item::find($item)->name }} </a></li>
        </ol>
    </section>
    <!-- end Directory&Header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><a href="#"><i class="fa fa-android"></i> Gallery List</a></h3>
                    </div>
                    <div class="box-body">
                        @if($errors->has('id'))
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="alert alert-danger alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h4><i class="icon fa fa-ban"></i> Oops! Something went wrong. </h4>
                                    You have to select One Image at less
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row with-border">
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <select class="form-control" id="selectNav">
                                        <option>Select</option>
                                        <option value="all">All</option>
                                        <option value="none">None</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <form method="post" action="{{route('ItemGallery.destroy',['$id'=>$item])}}">
                            <input type="hidden" value="DELETE" name="_method">
                            <input type="hidden" value="{{csrf_token()}}" name="_token">
                            @foreach($images->chunk(6) as $chunk )
                            <div class="row margin-bottom">
                                @foreach ($chunk as $image)
                                <div class="col-sm-2" style="text-align: center;">
                                    <img src="{{asset('images/gallery/thumb/'.$image->img)}}" alt="..." class="img-rounded margin-bottom" width="100%">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="checkbox" name="id[]" value="{{ $image->id }}">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                            <div class="row">
                                <div class="col-md-12">
                                    <a href="{{ route('Items.edit',['item'=>$item]) }}" class="btn btn-bitbucket"><i class="fa fa-dashboard"></i> Return Back to Item Dashboard</a>
                                    <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                                    <a href="{{ route('ItemGallery.create',['id'=>$item])  }}" class="btn btn-primary">Upload New Images</a>
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

@endsection