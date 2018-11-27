<html>
<head>
    <style>
        @import url('https://fonts.googleapis.com/css?family=Lato:300,400,700');

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Lato', sans-serif;
            color: #2c3e50;
        }

        .container {
            width: 100%;
            background-color: #e6e6e6;
            padding: 10px 0;
        }

        span {
            display: block;
        }

        .msg-container {
            width: 94%;
            margin: 10px auto;
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #c8c6c6;

        }

        .logo-holder {
            display: block;
            padding-bottom: 10px;
            position: relative;
            margin-bottom: 15px;
        }

        .logo-holder:after {
            position: absolute;
            top: 100%;
            left: 0;
            height: 1px;
            width: 100%;
            background-color: #c8c6c6;
            content: '';
        }

        table {
            width: 90%;
            margin: 10px auto;
            text-align: center;
            /*border: 1px solid #c8c6c6;*/
        }

        table > thead > tr > th, table > tbody > tr > td {
            border-bottom: 1px solid #c8c6c6;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        h2 {
            font-style: italic;
            font-weight: 300;
            margin: 0;
            color: #e74c3c;
        }

        .customer-service {
            font-style: italic;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="msg-container">
    <span class="logo-holder">
        <img src="{{asset('images/logo.png')}}">
    </span>
        Dear {{$reservation->customer->name}}
        <p>Thank you for choosing to book with {{Request::getHost()}}</p>
        <p>I am pleased to confirm receipt of your booking as follows:</p>
        <span class="details-header">YOUR BOOKING DETAILS</span>
        <table>
            <thead>
            <tr>
                <th>Tour</th>
                <th>Travellers</th>
                <th>Date</th>
                <th>Total</th>
                <th>Deposit</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reservation->items as $item)
                <tr>
                    <td>{{$item->item->title}}</td>
                    <td>
                        {{$item->st_num}} {{$item->st_name}}
                        @if($item->sec_num >0)
                            | {{$item->sec_num}} {{$item->sec_name}}
                        @endif
                    </td>
                    <td>{{$item->date}}</td>
                    <td>{{$item->currency}}{{sprintf('%.2f',$item->total)}}</td>
                    <td>{{$item->currency}}{{sprintf('%.2f',$item->deposit)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <span>Total:{{translate('$')}}{{sprintf('%.2f',$reservation->total)}}</span>
        <span>Deposit:{{translate('$')}}{{sprintf('%.2f',$reservation->deposit)}}</span>
        <span>Transaction ID: {{$reservation->paymentId}}</span>
        <span>Payment method: {{$reservation->payment_method}}</span>
        <br>
        <span>You can make login using ( Email:{{$reservation->customer->email}} | Password:booking ) to manage your booking, if you don't have account</span>
        <br><br>
        <h2>Best Regards</h2>
        <span class="customer-service">{{Request::getHost()}} Customer Service Team</span>
    </div>
</div>
</body>
</html>