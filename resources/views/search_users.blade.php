@include('libs')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-3">Name: </div>
        <div class="col-md-1">Sex: </div>
        <div class="col-md-2">Country: </div>
        <div class="col-md-2">City: </div>
    </div>
    @foreach($users as $user)
        <div class="row">
            <div class="col-md-3">
                @if($user->remember_token == 2 || $user->remember_token == 1)
                    <img src="{{$user->img_url}}">
                @else
                    <img src="/images/{{$user->img_url}}">
                @endif
            </div>
            <div class="col-md-3">
                {{$user->name}}&nbsp;&nbsp;&nbsp;{{$user->surname}}
            </div>
            <div class="col-md-1">
                {{$user->sex}}
            </div>
            <div class="col-md-2">
                {{$user->country}}
            </div>
            <div class="col-md-2">
                {{$user->city}}
            </div>
        </div>
    @endforeach
    <center>
        {!!$pagination!!}
        <br/>
        <a href="/">Back</a>
    </center>
</div>