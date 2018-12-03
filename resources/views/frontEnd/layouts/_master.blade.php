<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @yield('meta_tags')
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.min.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    @yield('_extra_css')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
</head>
<body id="exc">
@include('frontEnd.layouts.notify')
@include('frontEnd.layouts._mobile_header')
@yield('extra-plugged-in')
@yield('header-nav')
@yield('content')
{{-- footer --}}
<div class="row footer">
    <div class="container" style="position: relative;">
        <div class="row">
            @foreach( App\Models\Topic::where('footer',1)->orderBy('arrangement','desc')->limit(9)->get()->chunk(3) as $footerChunk)
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <ul>
                        @foreach($footerChunk as $footer)
                            <li>
                                <a href="{{ route('topics.show',['topicsName'=>urlencode($footer->name)]) }}">{{ $footer->footer_link }} </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
            <div class="col-md-3">
                <div class="row">
                    <span class="glyphicon glyphicon-envelope" style="margin-right: 10px; font-size: 20px;"></span>
                    Newsletter: Get the best travel deals delivered to your inbox!
                </div>
                <div class="row">
                    <form>
                        <div class="col-md-10 col-sm-10 col-xs-10" style="padding-left: 0; padding-right: 0;">
                            <input type="text" value="" class="form-control" placeholder="Your mail">
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-2" style="padding-left: 5px;">
                            <button class="btn btn-success" style="padding: 5px;">
                                <i class="fa fa-check" style="font-size: 20px;"></i>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row footer-social-links">
                    <div class="col-md-12 col-sm-8 col-xs-8">
                        <a href="{{translate('facebook-link')}}"> <i class="fa fa-facebook"></i></a>
                        <a href="{{translate('twitter-link')}}"> <i class="fa fa-twitter"></i></a>
                        <a href="{{translate('google-link')}}"> <i class="fa fa-google-plus"></i></a>
                        <a href="{{translate('pin-link')}}"> <i class="fa fa-pinterest-p"></i></a>
                        <a href="#"> <i class="fa fa-feed"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row text-center" style="background-color: #f2f2f2; padding: 10px;">
    © 2017 {{Request::getHost()}} All Rights Reserved
</div>
<div class="row footer-share-bottom">
    <div class="col-md-3 footer-share-div twiter-share" onclick="location.href = '{{translate('twitter-link')}}'">
        <div class="footer-share-text">
            <i class="fa fa-twitter"></i>{{translate('FOLLOW_US')}}
        </div>
    </div>
    <div class="col-md-3 footer-share-div facebook-share" onclick="location.href = '{{translate('facebook-link')}}'">
        <div class="footer-share-text">
            <i class="fa fa-facebook"></i>{{translate('LIKE_US')}}
        </div>
    </div>
    <div class="col-md-3 footer-share-div footer-google" onclick="location.href = '{{translate('google-link')}}'">
        <div class="footer-share-text">
            <i class="fa fa-google-plus"></i>{{translate('CONNECT')}}
        </div>
    </div>
    <div class="col-md-3 footer-share-div footer-pin" onclick="location.href = '{{translate('pin-link')}}'">
        <div class="footer-share-text">
            <i class="fa fa-pinterest-p"></i>{{translate('PIN_US')}}
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script>
    $(".main-nav-lunch").on('click', function () {
        var parent = $(this).closest('.mobile-header');
        var mainNav = $('section.main-nav');
        if (parent.hasClass('lunched')) {
            parent.removeClass('lunched');
            mainNav.removeClass('lunched');
            return true;
        }
        parent.addClass('lunched');
        mainNav.addClass('lunched');
    });
</script>
@yield('_nav_js')
@yield('_extra_js')
</body>
</html>