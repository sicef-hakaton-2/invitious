@include('libs')
<div class="container">
    <div class="row">
        <div class="col-md-3">Name: </div>
        <div class="col-md-3">Type: </div>
        <div class="col-md-3">Country: </div>
        <div class="col-md-2">City: </div>
        <div class="col-md-1">Free: </div>
    </div>
    @foreach($organizations as $organization)
        <a href="/organization/{{$organization->id}}">
            <div class="row">
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