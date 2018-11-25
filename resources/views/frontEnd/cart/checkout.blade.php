@extends('frontEnd.layouts._master')
@section('meta_tags')
    <title>{{ translate('Shopping_Cart')}} | {{Request::getHost()}}</title>
@endsection
@section('header-nav')
    <div class="row insider-header-container-sp">
        @include('frontEnd.layouts._mainNav')
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="container">
            <div class="row cart-items-holder">
                <div class="col-md-8 checkout-form">
                    <h3>
                        Checkout
                        <span>all fields are required</span>
                    </h3>
                    <?php
                    $customer_id = null;
                    $first_name = null;
                    $last_name = null;
                    $email = null;
                    $phone = null;
                    if (Auth::guard('customer')->check()) {
                        $customer = Auth::guard('customer')->user();
                        $customer_id = $customer->id;
                        $first_name = substr(trim($customer->name), 0, strpos(trim($customer->name), " "));
                        $last_name = substr(trim($customer->name), strpos(trim($customer->name), " ") + 1);
                        $email = $customer->email;
                        $phone = $customer->information->phone;
                    }
                    ?>
                    <form action="{{route('cart.checkout')}}" method="post" id="checkOutForm">
                        {{csrf_field()}}
                        <input id="token" name="token" type="hidden" value="">
                        <input type="hidden" name="deposit" value="{{$cart->deposit}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input class="form-control" name="first_name" value="{{$first_name}}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input class="form-control" name="last_name" value="{{$last_name}}" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" value="{{$email}}" required>
                                    <div class="help-block">
                                        This is where we will send the booking confirmation
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" name="phone" value="{{$phone}}" required>
                                    <div class="help-block">
                                        The tour operator will call this number if they need to reach you.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="checkout-form-section">
                            <h3>{{translate('Payment_Options')}}</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="payment_method"
                                               value="credit"
                                               checked>
                                        <label class="form-check-label">
                                            {{translate('Credit_Card')}}
                                            <div class="symbol-credit">
                                                <svg class="paymentLogo border-hr rounded" width="40" height="27"
                                                     aria-hidden="true"
                                                     role="img" viewBox="0 0 140 90"><title id="title">Visa</title>
                                                    <rect width="140" height="90" style="fill:#fff"></rect>
                                                    <g id="g4158">
                                                        <polygon id="polygon9"
                                                                 points="62.7 62.1 53.9 62.1 59.4 28 68.2 28 62.7 62.1"
                                                                 style="fill:#00579f"></polygon>
                                                        <path id="path11"
                                                              d="M94.7,28.8a21.16,21.16,0,0,0-7.9-1.5c-8.7,0-14.8,4.6-14.9,11.3-.1,4.9,4.4,7.6,7.7,9.3s4.6,2.8,4.6,4.3c0,2.3-2.8,3.3-5.3,3.3a17.06,17.06,0,0,1-8.3-1.8l-1.2-.5-1.2,7.7A27.57,27.57,0,0,0,78,62.7c9.3,0,15.3-4.6,15.4-11.7,0-3.9-2.3-6.9-7.4-9.3-3.1-1.6-5-2.6-5-4.2s1.6-2.9,5.1-2.9a15,15,0,0,1,6.6,1.3l.8.4Z"
                                                              style="fill:#00579f"></path>
                                                        <path id="path13"
                                                              d="M106.5,50l3.5-9.5c0,.1.7-2,1.2-3.3l.6,2.9s1.7,8.2,2,9.9Zm10.9-22h-6.8c-2.1,0-3.7.6-4.6,2.8L92.8,62.1h9.3s1.5-4.2,1.8-5.1h11.3c.2,1.2,1,5.1,1,5.1h8.2C124.5,62.1,117.4,28,117.4,28Z"
                                                              style="fill:#00579f"></path>
                                                        <path id="path15"
                                                              d="M46.5,28,37.9,51.3,37,46.6c-1.6-5.5-6.6-11.4-12.2-14.3l7.9,29.9H42L55.9,28Z"
                                                              style="fill:#00579f"></path>
                                                        <path id="path17"
                                                              d="M29.9,28H15.6l-.1.7c11.1,2.8,18.4,9.7,21.4,17.9L33.8,30.9C33.3,28.7,31.8,28.1,29.9,28Z"
                                                              style="fill:#faa61a"></path>
                                                    </g>
                                                </svg>
                                                <svg class="paymentLogo border-hr rounded" width="40" height="27"
                                                     aria-hidden="true"
                                                     role="img" viewBox="0 0 140 90" aria-label="title">
                                                    <defs>
                                                        <linearGradient id="amex-linear-gradient" x1="70" y1="-92"
                                                                        x2="70"
                                                                        y2="-2"
                                                                        gradientTransform="translate(0 92)"
                                                                        gradientUnits="userSpaceOnUse">
                                                            <stop offset="0" stop-color="#83cbed"></stop>
                                                            <stop offset="1" stop-color="#2983ba"></stop>
                                                        </linearGradient>
                                                    </defs>
                                                    <title id="title">Amex</title>
                                                    <rect width="140" height="90"
                                                          style="fill:url(#amex-linear-gradient)"></rect>
                                                    <path d="M40.93,44V42.51L40.22,44h-6l-.77-1.56V44H22.11l-1.34-3.12H18.51L17.09,44H7.35l3.9-9.54,4.3-9.73h8.23l1.15,2.76V24.73H35l2.2,4.67,2.17-4.67H71.1a5.37,5.37,0,0,1,2.76.74v-.74h8.08v1.06a6.38,6.38,0,0,1,3.57-1.06h14l1.25,2.79V24.71h9l1.72,2.79V24.71h8.57V44h-8.89l-2.08-3.37V44h-11l-1.56-3.44H94.41L92.94,44H86.26a8.72,8.72,0,0,1-4.37-1.37V44H68.58V39.47c0-.65-.5-.61-.5-.61H67.6V44Z"
                                                          style="fill:#fff"></path>
                                                    <path d="M34.29,48.14H51.78L54.3,51l2.59-2.85H70.33a6.23,6.23,0,0,1,2.46.67v-.67H84.74a6.2,6.2,0,0,1,2.79.76v-.76h15.39v.7a5.17,5.17,0,0,1,2.57-.7h10v.7a6.18,6.18,0,0,1,2.6-.7h9.35V66.31a13.77,13.77,0,0,1-4.68,1.17H112.44v-.57a5.26,5.26,0,0,1-2.49.57H82.39V62.81c0-.47-.2-.55-.61-.55h-.37V67.5H72.77V62.28a5.74,5.74,0,0,1-2.55.51H67.1v4.68H56.51l-2.41-3-2.59,3H34.29Z"
                                                          style="fill:#fff"></path>
                                                    <polygon
                                                            points="89.39 51.04 100.36 51.04 100.36 53.98 92.76 53.98 92.76 56.56 100.14 56.56 100.14 59.14 92.76 59.14 92.76 61.84 100.36 61.84 100.36 64.71 89.39 64.71 89.39 51.04"
                                                            style="fill:#0078a9"></polygon>
                                                    <path d="M121.56,56.34c4.13.22,4.48,2.27,4.48,4.47a4,4,0,0,1-4,4H114.7v-3h5.49c.94,0,2.32,0,2.32-1.31,0-.62-.25-1-1.23-1.12-.43,0-2.07-.16-2.32-.16-3.73-.09-4.6-2-4.6-4.21a3.77,3.77,0,0,1,3.53-4h7.52v3h-5.14c-1.17,0-2.43-.14-2.43,1.18,0,.85.62,1,1.42,1.1Z"
                                                          style="fill:#0078a9"></path>
                                                    <path d="M108.92,56.34c4.13.22,4.48,2.27,4.48,4.47a4,4,0,0,1-4,4h-7.32v-3h5.48c.94,0,2.33,0,2.33-1.31,0-.62-.25-1-1.23-1.12-.44,0-2.08-.16-2.33-.16-3.72-.09-4.6-2-4.6-4.21a3.79,3.79,0,0,1,3.55-4h7.49v3H107.6c-1.17,0-2.45-.14-2.45,1.18,0,.85.62,1,1.42,1.1Z"
                                                          style="fill:#0078a9"></path>
                                                    <path d="M69.13,51.07H57.36l-3.85,4.24L49.78,51H36.55V64.71H49.36l4-4.52,3.94,4.55h6.44V60.06h4.52c1.75,0,4.91,0,4.91-4.84a3.78,3.78,0,0,0-3.36-4.14h0A2.74,2.74,0,0,0,69.13,51.07ZM47.64,61.84H39.85v-2.7h7.41V56.56H39.85V54H48l3.27,3.73ZM60.47,63.4l-4.81-5.71,4.81-5.34ZM68,57.26H63.8V54H68a1.65,1.65,0,0,1,.32,3.28H68Z"
                                                          style="fill:#0078a9"></path>
                                                    <path d="M85.34,58.52a3.74,3.74,0,0,0,2.32-3.74,3.61,3.61,0,0,0-3.51-3.69H74.91v13.7h3.35V59.92h4.4c1.15,0,1.55,1.16,1.65,2.33l.09,2.51h3.27L87.55,62C87.53,59.74,86.93,58.71,85.34,58.52Zm-2.9-1.42H78.26V54h4.19a1.57,1.57,0,0,1,1.82,1.26,1.5,1.5,0,0,1,0,.3C84.31,56.49,83.81,57.1,82.44,57.1Z"
                                                          style="fill:#0078a9"></path>
                                                    <rect x="76.25" y="27.44" width="3.35" height="13.69"
                                                          style="fill:#0078a9"></rect>
                                                    <polygon
                                                            points="48.78 27.47 59.74 27.47 59.74 30.4 52.13 30.4 52.13 32.97 59.54 32.97 59.54 35.56 52.13 35.56 52.13 38.26 59.74 38.26 59.74 41.14 48.78 41.14 48.78 27.47"
                                                            style="fill:#0078a9"></polygon>
                                                    <path d="M72.18,34.9a3.7,3.7,0,0,0,2.32-3.78A3.6,3.6,0,0,0,71,27.43a2.26,2.26,0,0,0-.52,0h-8.8V41.12H65V36.31h4.44c1.17,0,1.56,1.15,1.65,2.32l.09,2.51h3.26l-.12-2.81C74.38,36.07,73.75,35.09,72.18,34.9Zm-2.9-1.41H65.09V30.37h4.19a1.56,1.56,0,0,1,1.82,1.25h0a1.61,1.61,0,0,1,0,.31C71.14,33,70.65,33.49,69.28,33.49Z"
                                                          style="fill:#0078a9"></path>
                                                    <path d="M41,27.45l-4.12,9.17-4.1-9.17H27.55V40.62L21.69,27.45H17.25l-6,13.67H14.8L16.11,38h6.7l1.33,3.11H30.9V31l4.49,10.14h3.12l4.46-10v10H46.4V27.45ZM17.39,35.12l2-4.78,2.09,4.78Z"
                                                          style="fill:#0078a9"></path>
                                                    <path d="M114.24,27.45v9.46l-5.66-9.46h-5V40.3L97.9,27.47H93.46L88.78,38.05H86.63c-.81-.17-2.07-.73-2.09-3.11v-1c0-3.21,1.75-3.45,4-3.45h2.07v-3H86.26c-1.56,0-4.85,1.17-5,6.78,0,3.79,1.56,6.91,5.3,6.91H91L92.34,38h6.75l1.32,3.12H107v-10l6,10h4.59V27.45ZM93.63,35.14l2-4.79,2.11,4.79Z"
                                                          style="fill:#0078a9"></path>
                                                </svg>
                                                <svg class="paymentLogo border-hr rounded" width="40" height="27"
                                                     aria-hidden="true"
                                                     role="img" viewBox="0 0 140 90"><title id="title">
                                                        MasterCard</title>
                                                    <rect width="140" height="90" style="fill:#fff"></rect>
                                                    <path d="M114.6,80.2v.2h.3v-.2Zm.1-.2c.1,0,.1,0,.2.1a.35.35,0,0,1,.1.2c0,.1,0,.1-.1.2a.35.35,0,0,1-.2.1l.2.3h-.2l-.2-.3h-.1v.3h-.2V80Zm0,1h.2c.1,0,.1-.1.2-.1s.1-.1.1-.2a.45.45,0,0,0,0-.5c-.1-.1-.2-.3-.3-.3a.45.45,0,0,0-.5,0c-.1,0-.1.1-.2.1s-.1.1-.1.2a.45.45,0,0,0,0,.5c.1.1.2.3.3.3h.3m0-1.4a.37.37,0,0,1,.3.1.22.22,0,0,1,.2.2l.2.2a.63.63,0,0,1-.2.8c-.1.1-.2.1-.2.2a.64.64,0,0,1-.6,0,.22.22,0,0,1-.2-.2.79.79,0,0,1-.2-.8.22.22,0,0,1,.2-.2c.1-.1.2-.1.2-.2a.37.37,0,0,1,.3-.1M43.5,76.9a2.3,2.3,0,1,1,2.3,2.4,2.24,2.24,0,0,1-2.3-2.18V76.9m6.2,0V73.1H48V74a2.91,2.91,0,0,0-2.4-1.1,4,4,0,1,0,0,8A3.16,3.16,0,0,0,48,79.8v.9h1.7Zm56,0a2.3,2.3,0,1,1,2.3,2.4,2.26,2.26,0,0,1-2.3-2.22V76.9m6.2,0V70h-1.7v4a2.91,2.91,0,0,0-2.4-1.1,4,4,0,1,0,0,8,3.16,3.16,0,0,0,2.4-1.1v.9h1.7ZM70.3,74.4a1.88,1.88,0,0,1,1.9,1.8h-4a2.07,2.07,0,0,1,2.1-1.8m-.1-1.5a3.7,3.7,0,0,0-3.8,3.6h0v.4a3.71,3.71,0,0,0,3.42,4h.48a4.35,4.35,0,0,0,3.1-1.1l-.8-1.2a3.54,3.54,0,0,1-2.2.8,2.12,2.12,0,0,1-2.3-1.9h5.7v-.6c0-2.4-1.5-4-3.6-4m20,4a2.3,2.3,0,1,1,2.3,2.4,2.26,2.26,0,0,1-2.3-2.22V76.9m6.2,0V73.1H94.9V74a2.91,2.91,0,0,0-2.4-1.1,4,4,0,0,0,0,8,3.16,3.16,0,0,0,2.4-1.1v.9h1.7ZM81,76.9a3.89,3.89,0,0,0,3.7,4h.4a4.19,4.19,0,0,0,2.7-.9L87,78.7a3.69,3.69,0,0,1-2,.7,2.45,2.45,0,0,1-2.3-2.59h0A2.56,2.56,0,0,1,85,74.5a3.09,3.09,0,0,1,2,.7l.8-1.3a3.85,3.85,0,0,0-2.7-.9A4,4,0,0,0,81,76.6v.3m21.4-4a2.33,2.33,0,0,0-2,1.1v-.9H98.7v7.6h1.7V76.4c0-1.3.6-2,1.6-2a3.78,3.78,0,0,1,1,.2l.5-1.6c-.4,0-.8-.1-1.1-.1m-44.5.8a5.54,5.54,0,0,0-3.1-.8c-1.9,0-3.2.9-3.2,2.4,0,1.2.9,2,2.6,2.2l.8.1c.9.1,1.3.4,1.3.8,0,.6-.6.9-1.7.9a4.3,4.3,0,0,1-2.5-.8l-.8,1.3a5.63,5.63,0,0,0,3.3,1c2.2,0,3.5-1,3.5-2.5s-1-2-2.7-2.3h-.8c-.7-.1-1.3-.2-1.3-.8s.5-.9,1.5-.9a4.18,4.18,0,0,1,2.4.7Zm21.4-.8a2.33,2.33,0,0,0-2,1.1v-.9H75.7v7.6h1.7V76.5c0-1.3.5-2,1.6-2a3.78,3.78,0,0,1,1,.2l.5-1.6a2.6,2.6,0,0,0-1.2-.2m-14.2.2H62.4V70.8H60.7v2.3H59.2v1.5h1.5v3.5c0,1.8.7,2.8,2.7,2.8a4,4,0,0,0,2.1-.6L65,78.9a2.35,2.35,0,0,1-1.5.4c-.8,0-1.1-.5-1.1-1.3V74.6h2.7ZM40.3,80.7V76a2.83,2.83,0,0,0-2.63-3H37.3a3,3,0,0,0-2.7,1.4A2.85,2.85,0,0,0,32.1,73a2.68,2.68,0,0,0-2.2,1.1v-.9H28.3v7.6H30V76.5a1.81,1.81,0,0,1,1.6-2h.3c1.1,0,1.7.7,1.7,2v4.2h1.7V76.5a1.81,1.81,0,0,1,1.6-2h.3c1.1,0,1.7.7,1.7,2v4.2Z"
                                                          style="fill:#231f20"></path>
                                                    <path d="M115.6,55.4V54.3h-.3l-.3.7-.3-.8h-.3v1.1h.2v-.8l.3.7h.2l.3-.7v.8Zm-1.9,0v-.9h.4v-.2h-.9v.2h.4v.9Z"
                                                          style="fill:#f79410"></path>
                                                    <path d="M82.6,60.2H57.4V15H82.5V60.2Z" style="fill:#ff5f00"></path>
                                                    <path d="M59,37.6A29,29,0,0,1,70,15a28.74,28.74,0,1,0,0,45.2A29,29,0,0,1,59,37.6"
                                                          style="fill:#eb001b"></path>
                                                    <path d="M116.5,37.6A28.71,28.71,0,0,1,70.1,60.2,28.66,28.66,0,0,0,75,20l0-.06a27.26,27.26,0,0,0-4.8-4.8,28.64,28.64,0,0,1,46.4,22.5"
                                                          style="fill:#f79e1b"></path>
                                                </svg>
                                                <svg class="paymentLogo border-hr rounded" width="40" height="27"
                                                     aria-hidden="true"
                                                     role="img" viewBox="0 0 140 90"><title id="title">Discover</title>
                                                    <defs>
                                                        <linearGradient id="af4e237f-d5bf-4bdd-85b7-08e1d91e0b7c"
                                                                        x1="79.25"
                                                                        y1="136.36" x2="71.75" y2="148.1"
                                                                        gradientTransform="matrix(1, 0, 0, -1, 0, 184)"
                                                                        gradientUnits="userSpaceOnUse">
                                                            <stop offset="0" stop-color="#f89f20"></stop>
                                                            <stop offset="0.25" stop-color="#f79a20"></stop>
                                                            <stop offset="0.53" stop-color="#f68d20"></stop>
                                                            <stop offset="0.62" stop-color="#f58720"></stop>
                                                            <stop offset="0.72" stop-color="#f48120"></stop>
                                                            <stop offset="1" stop-color="#f37521"></stop>
                                                        </linearGradient>
                                                        <linearGradient id="809b71cc-06f0-46bb-8900-7b8b671df5e0"
                                                                        x1="78.06"
                                                                        y1="136.53" x2="67.11" y2="157.93"
                                                                        gradientTransform="matrix(1, 0, 0, -1, 0, 184)"
                                                                        gradientUnits="userSpaceOnUse">
                                                            <stop offset="0" stop-color="#f58720"
                                                                  stop-opacity="0"></stop>
                                                            <stop offset="0.11" stop-color="#ee7f23"
                                                                  stop-opacity="0.14"></stop>
                                                            <stop offset="0.31" stop-color="#e37227"
                                                                  stop-opacity="0.35"></stop>
                                                            <stop offset="0.5" stop-color="#db682a"
                                                                  stop-opacity="0.52"></stop>
                                                            <stop offset="0.69" stop-color="#d5612c"
                                                                  stop-opacity="0.64"></stop>
                                                            <stop offset="0.85" stop-color="#d15d2e"
                                                                  stop-opacity="0.71"></stop>
                                                            <stop offset="0.98" stop-color="#d05b2e"
                                                                  stop-opacity="0.74"></stop>
                                                        </linearGradient>
                                                    </defs>
                                                    <rect width="140" height="90" style="fill:#fff"></rect>
                                                    <path d="M31.57,90H140V51.13C139.88,51.22,101.6,78,31.57,90Z"
                                                          style="fill:#f48120"></path>
                                                    <ellipse cx="73.71" cy="38.96" rx="10.88" ry="10.8"
                                                             style="fill:url(#af4e237f-d5bf-4bdd-85b7-08e1d91e0b7c)"></ellipse>
                                                    <ellipse cx="73.71" cy="38.96" rx="10.88" ry="10.8"
                                                             style="opacity:0.6499999761581421;isolation:isolate;fill:url(#809b71cc-06f0-46bb-8900-7b8b671df5e0)"></ellipse>
                                                    <path d="M19.29,46.67A9.86,9.86,0,0,0,23,39c0-6-4.51-10-11-10H6V49h6A10.69,10.69,0,0,0,19.29,46.67ZM10.07,46V32h1.15c2.58,0,4.14.55,5.46,1.73a6.85,6.85,0,0,1,2.2,5.1A6.94,6.94,0,0,1,12.21,46h0a8.34,8.34,0,0,1-1,0Zm15.11,3V29h4V49Zm15.18-6a2.45,2.45,0,0,0-1.2-2.1,16.29,16.29,0,0,0-2.76-1.16c-3.75-1.34-5-2.77-5-5.57,0-3.32,2.76-5.82,6.38-5.82a9,9,0,0,1,6,2.25L41.7,33.34a4.16,4.16,0,0,0-3.22-1.64c-1.72,0-3,1-3,2.25,0,1.1.71,1.68,3.11,2.56,4.53,1.65,5.88,3.11,5.88,6.34,0,3.93-2.91,6.67-7,6.67a8,8,0,0,1-7-3.87L33,43.19a4.7,4.7,0,0,0,4.34,2.72,2.9,2.9,0,0,0,3.08-2.7V43Zm9.44-4.17a6.65,6.65,0,0,0,6.28,7h0a5,5,0,0,0,.55,0c1.82,0,2.76-.64,4.78-2.22V48.3a11.73,11.73,0,0,1-5,1.18A10.53,10.53,0,0,1,45.7,39.19v-.31a10.72,10.72,0,0,1,15.74-9.36v4.66c-2-1.61-3-2.29-5-2.29a6.78,6.78,0,0,0-6.69,6.86v.12ZM92,50,83.35,29h4.36l5.46,13.64L98.7,29H103L94.17,50Zm16.75-18v5h7v3h-7v6h7v3h-11V29h11.08v3Zm23.16,2.86c0-3.8-2.64-5.86-7.24-5.86h-5.85V49h4V41h.39l5.52,8h4.9l-6.43-8.47a5.31,5.31,0,0,0,4.68-5.7Zm-8,3.14h-1V32H124c2.48,0,3.83,1,3.83,2.93s-1.37,3.07-4,3.07Zm10.56-8.5a.56.56,0,0,0-.56-.56h-.7v1.75h.43V30l.51.69h.52l-.56-.69a.48.48,0,0,0,.39-.53Zm-.76.24h-.07v-.5h.08c.22,0,.33.08.33.23s-.06.24-.31.24Zm1.72.09a1.57,1.57,0,1,0-1.58,1.56h0a1.54,1.54,0,0,0,1.55-1.53v0h0Zm-2.8,0a1.25,1.25,0,1,1,1.25,1.28,1.25,1.25,0,0,1-1.25-1.28v0Z"
                                                          style="fill:#231f20"></path>
                                                </svg>
                                            </div>
                                        </label>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input" name="payment_method"
                                               value="paypal">
                                        <label class="form-check-label">
                                            {{translate('Paypal')}}
                                            <div class="symbol-credit">
                                                <svg class="paymentLogo border-hr rounded" width="40" height="27"
                                                     aria-hidden="true" role="img" viewBox="0 0 67 44"><title>
                                                        paypal</title>
                                                    <rect width="67" height="44" style="fill:#fff"></rect>
                                                    <g id="logotext">
                                                        <path d="M22.013,28a1.731,1.731,0,0,1,1.83,2.089c-.152,1.768-1.032,2.753-2.417,2.757H20.219c-.174,0-.258.153-.3.469l-.233,1.609c-.035.243-.15.363-.32.363H18.237c-.179,0-.242-.124-.2-.4l.93-6.45c.046-.317.158-.435.356-.435Zm-1.832,3.453H21.1c.572-.024.953-.453.991-1.228a.722.722,0,0,0-.75-.818l-.862,0-.3,2.042ZM26.9,34.792c.1-.1.208-.153.193-.029l-.037.3c-.019.156.038.239.173.239h1c.168,0,.25-.073.291-.355l.616-4.184c.031-.21-.016-.313-.164-.313h-1.1c-.1,0-.147.06-.173.224l-.041.258c-.021.134-.078.157-.131.022a1.24,1.24,0,0,0-1.328-.677A2.87,2.87,0,0,0,23.509,33.2a1.957,1.957,0,0,0,1.841,2.242,1.908,1.908,0,0,0,1.55-.65Zm-.836-.642a1.06,1.06,0,0,1-1.029-1.275,1.474,1.474,0,0,1,1.38-1.275,1.06,1.06,0,0,1,1.029,1.275,1.475,1.475,0,0,1-1.38,1.275Zm5.027-3.714H30.082c-.209,0-.294.165-.228.376L31.112,34.8l-1.239,1.9c-.1.158-.024.3.122.3h1.139a.34.34,0,0,0,.338-.18l3.869-6.008c.119-.185.062-.379-.133-.379H34.132c-.185,0-.26.079-.366.246l-1.613,2.534-.718-2.539a.312.312,0,0,0-.344-.237Z"
                                                              style="fill:#113984;fill-rule:evenodd"></path>
                                                        <path d="M39.037,28a1.731,1.731,0,0,1,1.83,2.089c-.152,1.768-1.033,2.753-2.417,2.757H37.243c-.174,0-.258.153-.3.469l-.233,1.609c-.035.243-.15.363-.32.363H35.261c-.179,0-.242-.124-.2-.4l.93-6.45c.045-.317.158-.435.356-.435Zm-1.832,3.453h.916c.573-.024.954-.453.992-1.228a.723.723,0,0,0-.75-.818l-.862,0-.3,2.042Zm6.719,3.339c.1-.1.208-.153.192-.029l-.036.3c-.019.156.038.239.172.239h1c.168,0,.25-.073.292-.355l.616-4.184c.031-.21-.016-.313-.164-.313H44.9c-.1,0-.147.06-.173.224l-.041.258c-.021.134-.078.157-.131.022a1.241,1.241,0,0,0-1.328-.677A2.87,2.87,0,0,0,40.533,33.2a1.957,1.957,0,0,0,1.84,2.242,1.909,1.909,0,0,0,1.551-.65Zm-.836-.642a1.06,1.06,0,0,1-1.029-1.275A1.473,1.473,0,0,1,43.438,31.6a1.059,1.059,0,0,1,1.029,1.275,1.474,1.474,0,0,1-1.379,1.275ZM47.7,35.309H46.543a.144.144,0,0,1-.141-.173l1.014-6.949a.2.2,0,0,1,.192-.172h1.153a.143.143,0,0,1,.141.172l-1.014,6.949a.2.2,0,0,1-.192.173Z"
                                                              style="fill:#009ee3;fill-rule:evenodd"></path>
                                                    </g>
                                                    <g id="brandmark-PP">
                                                        <path d="M33.893,11.293h6.713c3.6,0,4.961,1.506,4.751,3.723-.345,3.654-3.021,5.674-6.57,5.674H36.995c-.486,0-.814.266-.946.987l-.769,4.189a.507.507,0,0,1-.484.452H30.587c-.4,0-.537-.251-.433-.793l2.57-13.437c.1-.539.46-.795,1.169-.795Z"
                                                              style="fill:#009ee3;fill-rule:evenodd"></path>
                                                        <path d="M29.962,7h6.453c1.817,0,3.973.05,5.415,1.128a3.413,3.413,0,0,1,1.352,3.1c-.4,4.175-3.343,6.514-7.3,6.514H32.7c-.542,0-.9.3-1.053,1.128l-.889,4.787a.541.541,0,0,1-.506.516H26.281c-.441,0-.6-.286-.482-.905L28.661,7.908c.114-.615.512-.908,1.3-.908Z"
                                                              style="fill:#113984;fill-rule:evenodd"></path>
                                                        <path d="M32.3,17.732l1.086-5.7c.1-.5.426-.739,1.083-.739h6.216a7.191,7.191,0,0,1,2.512.378c-.624,3.505-3.359,5.452-6.941,5.452H33.188a.882.882,0,0,0-.887.609Z"
                                                              style="fill:#172c70;fill-rule:evenodd"></path>
                                                    </g>
                                                </svg>
                                            </div>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="checkout-form-section" id="credit-section">
                            <h3>{{translate('Payment_Details')}}</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Cardholder Name*</label>
                                        <input class="form-control" name="credit[name]" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Credit Card Number*</label>
                                        <input class="form-control" name="credit[cc_no]" id="ccNo" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Expiration Date*</label>
                                        <select name="credit[cc_expire_month]" class="form-control" id="expMonth"
                                                required>
                                            <option value="">MM</option>
                                            @for($i=1;$i<=12;$i++)
                                                <option value="{{sprintf('%02d',$i)}}">{{sprintf('%02d',$i)}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>-</label>
                                        <select name="credit[cc_expire_year]" class="form-control" id="expYear"
                                                required>
                                            <option value="">YYYY</option>
                                            @for($i=0;$i<20;$i++)
                                                <option value="{{\Carbon\Carbon::now()->addYear($i)->format('Y')}}">
                                                    {{\Carbon\Carbon::now()->addYear($i)->format('Y')}}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CVV Number*</label>
                                        <input class="form-control" name="credit[ccv]" id="cvv" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Country*</label>
                                        <select name="credit[country]" class="form-control">
                                            @include('frontEnd.cart.layouts.countryList')
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <section class="checkout-form-section">
                            <ul>
                                <li>You will be charged the deposit amount once your order is confirmed.</li>
                                <li>If confirmation isn't received instantly, an authorization for the deposit amount
                                    will
                                    be held until your booking is confirmed.
                                </li>
                                <li>You can cancel for free up to 48 hours before the day of the experience, local
                                    time.
                                </li>
                            </ul>
                            <div class="row">
                                <div class="col-md-12">
                                    <button class="btn btn-block no-paypal" id="bookNow">
                                        <span>{{translate('Book_Now')}}</span>
                                    </button>
                                </div>
                            </div>
                        </section>

                    </form>
                </div>
                <div class="col-md-4 checkout-review">
                    <h3>{{translate('Review_Order_Details')}}</h3>
                    <section>
                        @foreach($cart->items()->all() as $key=>$item)
                            <div class="row checkout-review-item">
                                <div class="col-md-7 checkout-review-item-details">
                                    <h2>{{$item->model->title}}</h2>
                                    @if($item->st_num)
                                        <span>
                                        <label class="numbers">{{$item->st_num}}</label>
                                            {{$item->st_name}} ×
                                            <label class="numbers">{{$item->currency}}{{sprintf('%.2f',$item->st_price)}}</label>
                                            {{translate('USD')}}
                                    </span>
                                    @endif
                                    @if($item->sec_num)
                                        <span>
                                        <label class="numbers">{{$item->sec_num}}</label>
                                            {{$item->sec_name}} ×
                                            <label class="numbers">{{$item->currency}}{{sprintf('%.2f',$item->sec_price)}}</label>
                                            {{translate('USD')}}
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-5 checkout-review-item-prices">
                                    <span>Total:</span> {{$item->currency}}{{sprintf('%.2f',$item->total)}}
                                    @if($item->deposit>0)
                                        <span>Deposit Due:</span> {{$item->currency}}{{sprintf('%.2f',$item->deposit)}}
                                    @else
                                        <span>No Deposit</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row checkout-review-cancel">
                                <div class="col-md-12">
                                    <i class="fas fa-check"></i> Free cancellation before
                                    {{\Carbon\Carbon::parse($item->date)->subDay(2)->format('l, M d, Y')}}
                                </div>
                            </div>
                        @endforeach
                    </section>
                    <section class="checkout-review-total">
                        <div class="row">
                            <div class="col-md-6">
                                <span>{{translate('total')}}</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <label>{{translate('$')}}{{sprintf('%.2f',$cart->total)}} {{translate('USD')}}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span>{{translate('Deposit_due')}}</span>
                            </div>
                            <div class="col-md-6 text-right">
                                <label>{{translate('$')}}{{sprintf('%.2f',$cart->deposit)}} {{translate('USD')}}</label>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('_extra_js')
    <script src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
    <script>
        let form = $('form#checkOutForm');

        function changeButton(value) {
            let button = $("button#bookNow");
            if (value === "paypal") {
                button.removeClass('no-paypal').addClass('with-paypal');
                button.find('span').text("{{translate('pay_with')}}");
                return true;
            }
            button.removeClass('with-paypal').addClass('no-paypal');
            button.find('span').text("{{translate('Book_Now')}}");
        }

        function hideCreditSection(value) {
            let section = $("section#credit-section");
            let allInputs = section.find(":input");
            let allSelection = section.find("select");
            if (value === "paypal") {
                section.fadeOut();
                removeRequiredAttr(allInputs, allSelection);
                return true;
            }
            section.fadeIn();
            addRequiredAttr(allInputs, allSelection);
        }

        function removeRequiredAttr(inputs, selections) {
            inputs.prop('required', false);
            selections.prop('required', false);
        }

        function addRequiredAttr(inputs, selections) {
            inputs.prop('required', true);
            selections.prop('required', true);
        }

        function readyFromFor(value) {
            if (value === "paypal") {
                form.addClass('paypal');
                return true;
            }
            form.removeClass('paypal');
        }

        $("input[name='payment_method']").change(function () {
            let value = $(this).val();
            readyFromFor(value);
            changeButton(value);
            hideCreditSection(value);
        });
        // 2CheckOut Function
        let successCallback = function (data) {
            let form = document.getElementById('checkOutForm');
            form.token.value = data.response.token.token;
            form.submit();
        };
        let errorCallback = function (data) {
            if (data.errorCode === 200) {
                tokenRequest();
            } else {
                alert(data.errorMsg);
            }
        };

        let tokenRequest = function () {
            let args = {
                sellerId: "{{checkOutSettings('partner_id')}}",
                publishableKey: "{{checkOutSettings('public_key')}}",
                ccNo: $("#ccNo").val(),
                cvv: $("#cvv").val(),
                expMonth: $("#expMonth").val(),
                expYear: $("#expYear").val()
            };
            // Make  token request
            TCO.requestToken(successCallback, errorCallback, args);
        };

        $(function () {
            // Pull in the public encryption key for our environment
            TCO.loadPubKey('sandbox');

            $('#checkOutForm').submit(function (e) {
                if (!$(this).hasClass('paypal')) {
                    tokenRequest();
                    return false;
                }
            });
        });
    </script>
@endsection