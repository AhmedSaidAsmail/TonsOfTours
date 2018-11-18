@extends('Web.Layouts._master')
@section('content')
<!-- welcome -->
<div class="main-box row">
    @foreach($Categories->chunk(3) as $chunks)
    <div class="row blocks-row">
        @foreach($chunks as $Category)
        <div class="col-md-4">
            <div class="blocks">
                <a href="{{route('cities.show',['city'=>urlencode($Category->name),'id'=>$Category->id])}}" title="{{$Category->name}}"><img alt="" src="images/sorts/thumb/{{$Category->img}}" /></a>
                <h6 class="blocks-title"><a href="{{route('cities.show',['city'=>urlencode($Category->name),'id'=>$Category->id])}}" title="Ras Mohamed By Boat"> {{$Category->name}}</a></h6>
            </div>
        </div>
        @endforeach
    </div>
    @endforeach
</div>
@endsection