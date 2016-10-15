@extends('master')
@section('content')
    @include('userNavBar')
    <div class="container">
    <div class="well panel panel-info">
        <div class="row panel-heading visible-md">
            <div class="col-md-3 panel-title">Name: </div>
            <div class="col-md-3 panel-title">Type: </div>
            <div class="col-md-3 panel-title">Country: </div>
            <div class="col-md-2 panel-title">City: </div>
            <div class="col-md-1 panel-title">Free: </div>
        </div>
        @foreach($organizations as $organization)
            <a href="/organization/{{$organization->id}}">
                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-3">{{$organization->name}}</div>
                    <div class="col-md-3">{{$organization->type}}</div>
                    <div class="col-md-3">{{$organization->country}}</div>
                    <div class="col-md-2">{{$organization->city}}</div>
                    <div class="col-md-1">{{$organization->free}}</div>
                </div>
            </a>
        @endforeach
        <center>{!!$pagination!!}</center>
    </div>
    </div>
@endsection