<ul>
    @foreach($items as $item)
    <li><a href="{{route('tour.show',['city'=>urlencode($item->sort->name),'tour'=>urlencode($item->name),'id'=>$item->id])}}">{{$item->title}}</a></li>
    @endforeach
</ul>