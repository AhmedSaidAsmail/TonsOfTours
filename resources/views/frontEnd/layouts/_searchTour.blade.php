@foreach($items as $item)
    <a href="">
        <div class="row">
            <div class="col-md-2 col-xs-1 col-sm-1">
                <img src="{{asset('images/items/thumbSm/'.$item->img)}}" alt="{{$item->title}}">
            </div>
            <div class="col-md-10 col-xs-11 col-sm-11">
                <h3>{!! preg_replace("/$keyword/i","<b>".ucfirst($keyword)."</b>",$item->title) !!}</h3>
                @if(isset($item->price))
                    <span>{{sprintf('%.2f',$item->price->st_price)}} $ {{translate('per_person')}}</span>
                @endif
            </div>
        </div>
    </a>
@endforeach