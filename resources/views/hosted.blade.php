@extends('master-admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-2">Name: </div>
            <div class="col-md-1">Sex: </div>
            <div class="col-md-2">Country: </div>
            <div class="col-md-2">City: </div>
        </div>
        @foreach($users as $user)
            <a href="/userP/{{$user->id}}">
                <div class="row" style="max-height: 100px; border-bottom: 1px solid">
                    <div class="col-md-3">
                        @if($user->remember_token == 2 || $user->remember_token == 1)
                            <img style="height: 100%; padding-bottom: 10px;" src="{{$user->img_url}}">
                        @else
                            <img style="height: 100%; padding-bottom: 10px;" src="/images/{{$user->img_url}}">
                        @endif

                    </div>

                    <div class="col-md-2">
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
                    <div class="col-md-1">
                        <form method="post" action="/organization/remove/hosted">
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <input type="hidden" name="org_id" value="{{$user->org_id}}">
                            <input type="submit" class="btn btn-primary" value="Remove">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                </div>
            </a>
        @endforeach
        <center>{!!$pagination!!}</center>
    </div>
@endsection