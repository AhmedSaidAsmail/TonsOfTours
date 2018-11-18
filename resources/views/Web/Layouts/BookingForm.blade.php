<form action="{{route('add.to.cart',['id'=>$item->id])}}" method="post">
    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
    <input type="hidden" name="item_id" value="{{$item->id}}"/>
    <div class="row booking-form">
        <div class="row booking-form-header">
            <i class="fa fa-folder" aria-hidden="true"></i> {{Vars::getVar('Book_Now')}}
        </div>
        <div class="row booking-form-row">
            <div class="col-md-5 col-lg-7"><span>{{$item->price->st_name}}</span></div>
            <div class="col-md-7 col-lg-5 text-right" id="first-price" >{{$item->price->st_price}}.00 <span>{{ Vars::getVar("$") }}</span></div>
        </div>
        <div class="row booking-form-row">
            <div class="col-md-5 col-lg-7"><span>{{$item->price->sec_name}}</span></div>
            <div class="col-md-7 col-lg-5 text-right" id="sec-price" >{{$item->price->sec_price}}.00 <span>{{ Vars::getVar("$") }}</span></div>
        </div>


        <div class="row booking-form-row-inputs">


            <div class="col-md-12">
                <div class="form-group">
                    <label class="daysoff" data="{{route('getDays',['id'=>$item->id])}}"><i class="fa fa-calendar"></i> {{Vars::getVar('Select_a_date')}}</label>
                    <input name="date" type="text" class="form-control" id="datepicker" >
                </div>
            </div>
        </div>

        <div class="row ">

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ $item->price->st_name }}</label>
                    <input name="st_no" id="first_amount" type="number" value="0" min="1" class="form-control">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label>{{ $item->price->sec_name }}</label>
                    <input name="sec_no" id="second_amount" type="number" value="0" min="0" class="form-control">
                </div>
            </div>
        </div>
        <div class="row booking-form-row-sp">
            <div class="col-md-5 col-lg-7"><span>{{Vars::getVar('TOTAL_COST')}}</span></div>
            <div class="col-md-7 col-lg-5 text-right"><span id="total">00.00</span> <span>{{ Vars::getVar("$") }}</span></div>
        </div>
        <div class="row text-center booking-form-row-normal">
            <button class="btn btn-success  btn-block booking-form-submit">
                <span class="glyphicon glyphicon-shopping-cart"></span> {{Vars::getVar('add_to_Basket')}} <span class="glyphicon glyphicon-arrow-right"></span>
            </button>
            <h3 class="text-center price-gurantee">
                <a href=""><span class="glyphicon glyphicon-bookmark"></span> Low Price Guarantee</a>

            </h3>
            <a class="btn btn-block booking-form-review">
                {{Vars::getVar('Review_your_orders')}}
            </a>
        </div>
    </div>
</form>