<form method="post" action="{{route('cart.store')}}">
    {{csrf_field()}}
    <input type="hidden" name="item_id" value="{{$item->id}}">
    <input type="hidden" name="date" value="{{$data['date']}}">
    <input type="hidden" name="title" value="{{$item->title}}">
    <input type="hidden" name="st_name" value="{{$item->price->st_name}}">
    <input type="hidden" name="st_price" value="{{$price->st_price}}">
    <input type="hidden" name="st_num" value="{{$data['st_num']}}">
    <input type="hidden" name="sec_name" value="{{$item->price->sec_name}}">
    <input type="hidden" name="sec_price" value="{{$price->sec_price}}">
    <input type="hidden" name="sec_num" value="{{$data['sec_num']}}">
    <input type="hidden" name="total" value="{{$total}}">
    <input type="hidden" name="deposit" value="{{payment()->deposit($item,$total)}}">
    <div class="booking-details">
        <div class="booking-details-header">
            {{translate('Tour_for')}} <span>{{$data['date']}}</span>
        </div>
        <div class="row booking-details-number">
            <div class="col-md-12">
                {{$data['st_num']}} {{$item->price->st_name}}
                × {{translate('$').sprintf("%.2f",$price->st_price)}} {{ payment()->currency }}
            </div>
            <div class="col-md-12">
                {{$data['sec_num']}} {{$item->price->sec_name}}
                × {{translate('$').sprintf("%.2f",$price->sec_price)}} {{ payment()->currency }}
            </div>
        </div>
        <div class="row booking-details-total">
            <div class="col-md-12">
                <span>{{translate('Total')}}: {{translate('$').sprintf("%.2f",$total)}} {{ payment()->currency }}</span>
                <button class="btn btn-success btn-block">Add to Cart <i class="fas fa-cart-plus"></i></button>
            </div>
        </div>
    </div>
</form>