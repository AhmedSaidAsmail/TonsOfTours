@extends('frontEnd.layouts._master')
@section('meta_tags')
    <title>{{$topic->title}}</title>
    <meta name="keywords" content="{{$topic->keywords}}">
    <meta name="description" content="{{$topic->description}}">
@endsection
@section('header-nav')
    <div class="row insider-header-container-sp">
        @include('frontEnd.layouts._mainNav')
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="row topics-holder">
                <div class="col-md-8">
                    <h1>{{$topic->title}}</h1>
                    <span class="last-updated">Last updated: {{\Carbon\Carbon::parse($topic->updated_at)->format('M d, Y')}}</span>
                    <div class="topic-text">
                        {!! $topic->txt !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
