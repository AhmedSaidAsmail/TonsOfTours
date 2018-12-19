@extends('Admin.Layouts._master')
@section('title','Items Panel')
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
            @if(count($errors)>0)
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
                        &times;
                    </button>
                    <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-xs-12">
                    <form method="post" action="{{route('item.update',['id'=>$item->id])}}"
                          enctype="multipart/form-data">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add Activities Data</h3>
                            </div>
                            <div class="box-body">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#general">General</a></li>
                                    <li><a data-toggle="tab" href="#over_view">OverView</a></li>
                                    <li><a data-toggle="tab" href="#includes">Includes</a></li>
                                    <li><a data-toggle="tab" href="#excludes">Excludes</a></li>
                                    <li><a data-toggle="tab" href="#price">Price</a></li>
                                    <li><a data-toggle="tab" href="#pricePackages">Price Packages</a></li>
                                    <li><a data-toggle="tab" href="#details">Details</a></li>
                                    <li><a data-toggle="tab" href="#gallery">Gallery</a></li>
                                </ul>

                                <div class="tab-content">
                                    {{-- General Inofrmation --}}
                                    @include('Admin._items.layouts._itemsGeneral')
                                    {{-- General Inofrmation --}}
                                    {{-- Intro --}}
                                    @include('Admin._items.layouts._itemsOverView')
                                    {{-- Intro --}}
                                    {{-- Includes --}}
                                    @include('Admin._items.layouts._itemsIncludes')
                                    {{-- Includes --}}
                                    {{-- Excludes --}}
                                    @include('Admin._items.layouts._itemsExcludes')
                                    {{-- Excludes --}}
                                    {{-- Price --}}
                                    @include('Admin._items.layouts._itemsPrice')
                                    {{-- Price --}}
                                    {{-- Price Packages--}}
                                    @include('Admin._items.layouts._itemsPricePackages')
                                    {{-- Price Packages--}}
                                    {{-- Price Details--}}
                                    @include('Admin._items.layouts._itemsDetails')
                                    {{-- Price Details--}}
                                    {{-- Items Gallery--}}
                                    @include('Admin._items.layouts._itemsGallery')
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success btn-block">Update Item</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('Extra_Css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/lib/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/lib/css/prettify.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/TextEditor/src/bootstrap-wysihtml5.css')}}"/>
    <link rel="stylesheet" href="{{asset('adminlte/plugins/select2/select2.min.css')}}">
    <style>
        .select2-container--default .select2-selection--single {
            border-radius: 0;
        }

        .select2-container .select2-selection--single {
            height: inherit;
        }

        .select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
            padding: 5px 12px;
        }

    </style>

@endsection
@section('Extra_Js')
    <script src="{{asset('css/admin/TextEditor/lib/js/wysihtml5-0.3.0.js')}}"></script>
    <script src="{{asset('css/admin/TextEditor/lib/js/prettify.js')}}"></script>
    <script src="{{asset('css/admin/TextEditor/lib/js/highlight/highlight.pack.js')}}"></script>
    <script src="{{asset('css/admin/TextEditor/src/bootstrap-wysihtml5.js')}}"></script>
    <script src="{{asset('adminlte/plugins/select2/select2.full.min.js')}}"></script>
    <script>
        $('.text-area').wysihtml5({
            "stylesheets": ["{{asset('css/admin/TextEditor/lib/css/wysiwyg-color.css')}}", "{{asset('css/admin/TextEditor/lib/css/highlight/github.css')}}"],
            "color": true,
            "size": 'small',
            "html": true,
            "format-code": true
        });
        $(function () {
            $(".select-options").select2();
        });
    </script>
@endsection
