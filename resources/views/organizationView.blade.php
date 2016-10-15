@extends("master")
@section("head")
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <style>
        .form-control[disabled], fieldset[disabled] .form-control {
            cursor: default!important;
        }
    </style>
@endsection
@section("content")
    @if(!empty($user))
        @include("userNavBar")
    @elseif(!empty($organization))
        @include("organizationNavBar")

    @endif
    <div class="container ">

        <div class="col-md-12 well animated fadeInDown">
            <div class="col-md-3">
                <img style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);" src="http://brunchhubtest.com/images/org.jpg">
            </div>
            <div class="col-md-9">
                <form class="form-horizontal">
                    <fieldset>
                        <legend>Account</legend>
                        <div class="form-group">
                            <label for="firstName" class="col-lg-2 control-label">Name</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="firstName" placeholder="Name" disabled value="{{$organization['name']}}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="select" class="col-lg-2 control-label">Type</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" id="firstName" placeholder="Name" disabled value="{{$organization->type}}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="country" class="col-lg-2 control-label" >Country</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="country" placeholder="Country" disabled value="{{$organization->country}}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="city" class="col-lg-2 control-label">City</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="city" placeholder="City" disabled value="{{$organization->city}}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-lg-2 control-label">Address</label>
                            <div class="col-lg-10">
                                <input type="text" class="form-control" id="address" placeholder="Address" disabled value="{{$organization->address}}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="desc" class="col-lg-2 control-label">Description</label>
                            <div class="col-md-10" id="desc">
                                <textarea class="form-control" rows="3" name="description"  disabled placeholder="Description" style="max-width: 100%">{{$organization->description}}</textarea>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="capacity" class="col-lg-2 control-label">Capacity</label>
                            <div class="col-md-10" id="capacity">
                                <input type="number" class="form-control"  min="1" name="capacity" disabled placeholder="Enter capacity" value="{{$organization->capacity}}">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="capacity" class="col-lg-2 control-label">Reserved</label>
                            <div class="col-md-10" id="capacity">
                                <input type="number" class="form-control"  min="1" name="capacity" disabled placeholder="Enter capacity" value="{{$organization->reserved}}">

                            </div>
                        </div>
                        <input type="hidden" name="lat" id="lat" value="{{$organization->lat}}">
                        <input type="hidden" name="lon" id="lon"  value="{{$organization->lon}}">
                        <input type="hidden" name="id">
                        <div class="col-md-11 col-md-offset-1">
                            <div id="map" style="width: 100%;height: 300px; box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);"></div>
                        </div>

                    </fieldset>
                </form>
                @if(!empty($user))
                    @if($accCount>0)
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                            <h3>You're already hosted!</h3>
                            </div>
                        </div>
                    @elseif($reqCount > 0)
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                            <h3>Request sent.</h3>
                            </div>
                        </div>
                        @else
                <div class="row">
                    <div class="col-md-2"></div>
                    <form action="/send_req" method="post" enctype="multipart/form-data">

                        <button type="submit" class="btn btn-success hvr-grow">Send Request</button>
                        <input type="hidden" id="id_1" value="{{$user->id}}" name="user_id">
                        <input type="hidden" id="I" value="{{$organization->id}}" name="organization_id">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    </form>
                </div>
                    @endif
                    @endif
            </div>
        </div>
    </div>
@endsection
@section("footer")
    <script>
        var marker;

        function initialize() {
            var mapCanvas = document.getElementById('map');
            var mapOptions = {
                center: new google.maps.LatLng(43.321170, 21.895842),
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            var map = new google.maps.Map(mapCanvas, mapOptions)

            var temp = {lat: 43.321170, lng: 21.895842};

            marker = new google.maps.Marker({
                position: temp,
                map: map
            });
            google.maps.event.addListener(map, "rightclick", function(event) {

                marker.setMap(null);

                var lat = $("#lat").val();
                var lng = $("#lon").val();

                var myLatLng = {lat: lat, lng: lng};

                marker = new google.maps.Marker({
                    position: myLatLng,
                    map: map
                });

                $("#lat").val(lat);
                $("#lon").val(lng);
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);


    </script>
@endsection