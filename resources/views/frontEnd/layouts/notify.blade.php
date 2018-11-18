@if(count($errors)>0)
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <i class="fas fa-times-circle"></i>
        </button>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(Session::has('failure'))
    <div class="alert alert-danger alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <i class="fas fa-times-circle"></i>
        </button>
        {!! Session::get('failure') !!}
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success alert-dismissable">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
            <i class="fas fa-times-circle"></i>
        </button>
        {!! Session::get('success') !!}
    </div>
@endif