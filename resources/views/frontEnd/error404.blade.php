@extends('frontEnd.layouts._master')
@section('meta_tags')
    <title>404 Page Not Found</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container-sp">
        @include('frontEnd.layouts._mainNav')
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="empty-cart">
                <h1><i class="fas fa-exclamation-triangle text-danger"></i> 404 Not Found</h1>
                <span style="font-weight: 700; display: block;">Unfortunately the page you requested cannot be found.</span>
                Either the page is not available anymore, or the address (URL) you have entered is incorrect.
            </div>
        </div>
    </div>
@endsection
