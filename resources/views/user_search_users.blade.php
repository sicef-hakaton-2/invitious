
@extends('master')

@section('content')
    @include('userNavBar')
    <div class="container">
    <div class="well panel panel-info ">
        <div class="row panel-heading visible-md">
            <div class="col-md-3 panel-title"></div>
            <div class="col-md-3 panel-title">Name: </div>
            <div class="col-md-1 panel-title">Sex: </div>
            <div class="col-md-2 panel-title">Country: </div>
            <div class="col-md-2 panel-title">City: </div>
        </div>
        @foreach($users as $user)
            <a href="/userP/{{$user->id}}">
                <div class="row">
                    <div class="col-md-3 row1" >
                        @if($user->remember_token == 2 || $user->remember_token == 1)
                            <img class="profile_img" src="{{$user->img_url}}">
                        @else
                            <img class="profile_img" src="/images/{{$user->img_url}}">
                        @endif
                    </div>
                    <div class="col-md-3 row1">
                        <div class="tekst">{{$user->name}}&nbsp;&nbsp;&nbsp;{{$user->surname}}</div>
                    </div>
                    <div class="col-md-1 row1">
                        <div class="tekst">{{$user->sex}}</div>
                    </div>
                    <div class="col-md-2 row1">
                        <div class="tekst">{{$user->country}}</div>
                    </div>
                    <div class="col-md-2 row1">
                        <div class="tekst">{{$user->city}}</div>
                    </div>
                </div>
            </a>
        @endforeach
        <center>{!!$pagination!!}</center>
    </div>
    </div>
@endsection