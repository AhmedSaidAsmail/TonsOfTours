<h1>Reset Your {{Request::getHost()}} Password</h1>
<span style="display: block">Hi: {{$customer_email}}</span>
To reset your password, just click
<a href="{{route('customer.password.email.back',[
'email'=>$customer_email,
'unique_id'=>$unique_id
])}}">
    here
</a>.