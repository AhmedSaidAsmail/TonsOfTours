<div class="tour-booking-form">
    <form method="post" action="{{route('cart.availability',['id'=>$item->id])}}" id="check">
        {{csrf_field()}}
        <input type="hidden" name="st_name" value="{{$item->price->st_name}}">
        <input type="hidden" name="sec_name" value="{{$item->price->sec_name}}">
        <div class="row">
            <div class="col-md-12">
                <div class="price-starting-from">
                    <h1>from {{ payment()->currency_symbol .sprintf('%.2f',$item->cheapestPrise()->st_price)}}</h1>
                    <a href="">Low Price Guarantee</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-booking">
                <h2>Select Date and Travelers</h2>
                <div class="form-group form-date">
                    <div class="input-group">
                        <label class="input-group-addon date-click">
                            <i class="far fa-calendar-check"></i>
                        </label>
                        <input class="form-control tour-date" name="date"
                               value="{{\Carbon\Carbon::now()->format('l, M d, Y')}}" autocomplete="off"
                               data-language='en'
                               readonly required>
                    </div>
                </div>
                <div class="form-group form-travelers">
                    <div class="input-group">
                        <label class="input-group-addon">
                            <i class="far fa-user"></i>
                        </label>
                        <input class="form-control travelers-total" name="total_travelers"
                               placeholder="Number of travelers"
                               readonly required>
                    </div>
                </div>
                <div class="travelers-number-holder">
                    <div class="travelers-number">
                        <div class="row">
                            <div class="col-md-5 col-xs-5 col-sm-5">
                                <label>Adult</label>
                                <span>(age 12-60)</span>
                            </div>
                            <div class="col-md-7 col-xs-7 col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="number" value="0" min="0" max="40" name="st_num"
                                           required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-xs-5 col-sm-5">
                                <label>Child</label>
                                <span>(age 2-11)</span>
                            </div>
                            <div class="col-md-7 col-xs-7 col-sm-7">
                                <div class="form-group">
                                    <input class="form-control" type="number" value="0" min="0" max="20" name="sec_num"
                                           required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-block btn-primary"><i class="far fa-check-circle"></i> Check Availability
                </button>
            </div>
        </div>
    </form>
</div>
<div class="booking-review">
    <div class="booking-review-area">
        {{-- Booking Details--}}
    </div>
    <div class="waiting-review">
        <div class="animate-1"></div>
        <div class="animate-2"></div>
        <div class="animate-2"></div>
        <div class="animate-3"></div>
        <div class="animate-1"></div>
    </div>
</div>
<?php
$link = null;
$class = "disabled";
if (!$is_wish_list) {
    $link = route('wish-list.store', ['item_id' => $item->id]);
    $class = null;
}
?>
<a href="{{$link}}" class="wish-list-add {{$class}}"><i class="fas fa-heart"></i> Add to WishList </a>
@section('_extra_css')
    @parent
    <link rel="stylesheet" type="text/css" href="{{asset('resources/datepicker/css/datepicker.min.css')}}">
@endsection
@section('_extra_js')
    @parent
    <script type="text/javascript" src="{{asset('resources/datepicker/js/datepicker.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('resources/datepicker/js/i18n/datepicker.en.js')}}"></script>
    <script>
        $(".tour-date").datepicker({
            minDate: new Date(),
            dateFormat: 'DD, M dd, yyyy',
            autoClose: true,
        });
        $(function () {
            $(".date-click").on('click', function () {
                $(".tour-date").focus();
            });
            // travelers number functions
            let form = $("form#check");
            let bookingReview = $(".booking-review");
            let numberArea = $(".travelers-number-holder");
            let totalInput = $('input.travelers-total');
            let stInput = $("input[name='st_num']");
            let stName = stInput.closest('.row').find('label');
            let secInput = $("input[name='sec_num']");
            let secName = secInput.closest('.row').find('label');
            totalInput.on('click', function () {
                totalAreaAction();
            });
            $(document).on('click', function (a) {
                if (!$(a.target).closest(".form-booking").length) {
                    if (numberArea.is(":visible")) {
                        numberArea.removeClass('active');
                        countTotal();
                    }
                }
            });

            form.submit(function (event) {
                event.preventDefault();
                countTotal();
                preparingReviewArea();
                let url = $(this).attr('action');
                let data = $(this).serialize();
                $.ajax({
                    url: url,
                    type: "post",
                    data: data,
                    success: function (response) {
                        scrollToReview();
                        displayResult(response);
                    },
                    error: function (request, status, error) {
                        totalAreaShow();
                        hideReviewingArea();
                        let exception = JSON.parse(request.responseText);
                        if (exception.st_num.length) {
                            stInput.closest('.form-group').addClass('has-error');
                            stInput.focus();
                        }
                        console.log(exception);
                    }
                });
            });

            // total area showing function
            function preparingReviewArea() {
                bookingReview.show();
                bookingReview.find('.waiting-review').show();
                bookingReview.find('.booking-review-area').empty();
            }

            function hideReviewingArea() {
                bookingReview.hide();
                bookingReview.find('.waiting-review').hide();
            }

            function displayResult(response) {
                bookingReview.find('.waiting-review').hide();
                bookingReview.find('.booking-review-area').html(response);
            }

            function totalAreaAction() {
                if (!numberArea.is(":visible")) {
                    numberArea.addClass('active');
                    countTotal();
                    return true;
                }
                numberArea.removeClass('active');
                countTotal();
            }

            function totalAreaShow() {
                if (!numberArea.is(":visible")) {
                    numberArea.addClass('active');
                    countTotal();
                }
            }

            // count total function
            function countTotal() {
                let total = stInput.val() + " " + stName.text() + ", " + secInput.val() + " " + secName.text();
                totalInput.attr('value', total);

            }

            function scrollToReview() {
                $('html, body').animate({scrollTop: (bookingReview.offset().top - 100)}, 500);
            }
        });
    </script>
@endsection