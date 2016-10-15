@extends("master")
@section("head")
    <meta name="viewport" content="width=device-width, initial-scale=1.2">
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <link rel="stylesheet" href="http://brunchhubtest.com/css/hover-min.css">

@endsection
@section("content")
                <center>
                <ul class="nav nav-tabs navbar navbar-inverse" style="margin-bottom: 15px;">
                    <li style="width: 50%; font-size: 25px; font-family: 'Roboto', sans-serif; margin-top: 5px"><a href="{{URL::route('register/user')}}" class="btn btn-default">Refugee</a></li>
                    <li style="width: 50%; font-size: 25px; font-family: 'Roboto', sans-serif; margin-top: 5px"><a href="{{URL::route('register/organization')}}" class="btn btn-default">Organization</a></li>
                </ul>
                </center>
    <div class="container">


        <div class="row">

            <div class="regOrg">
                    <div class="col-md-2"></div>
                    <center>
                    <div class="col-md-8 well animated fadeInDown">
                <form method="post" action="{{URL::route('register/organization/check')}}">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <center>
                        <div class="col-md-8">
                            <h2 style="font-size: 25px; font-family: 'Roboto', sans-serif;">Organization register</h2>
                        </div>
                        </center>
                    </div>

                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <fieldset style="margin-left: 30px; margin-right: 30px">


                    <input type="text" class="form-control"  name="username" placeholder="Enter username" value="{{old('username')}}">
                        @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                    <input type="password" class="form-control"  name="password" placeholder="Enter password" value="{{old('password')}}">
                        @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                    <input type="text" class="form-control"  name="name" placeholder="Enter name" value="{{old('name')}}">
                        @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                    <select class="form-control" name="type" id="select">
                        <option value="" disabled>Select type</option>
                        <option value="reception center">Recepcion Center</option>
                        <option value="private accommodation">Private accommodation</option>
                        <option value="kitchen">Kitchen</option>
                    </select>
                        @if ($errors->has('type')) <p class="help-block">{{ $errors->first('type') }}</p> @endif
                    <input type="text" class="form-control"  name="email" placeholder="Enter email" value="{{old('email')}}">
                        @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                    <input type="text" class="form-control"  name="country" placeholder="Enter country" value="{{old('country')}}">
                        @if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p> @endif
                    <input type="text" class="form-control"  name="city" placeholder="Enter city" value="{{old('city')}}">
                        @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
                    <input type="text" class="form-control"  name="address" placeholder="Enter address" value="{{old('address')}}">
                        @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
                    <div id="map" style="width: 100%; height: 200px"></div>
                        @if ($errors->has('lon') || $errors->has('lat')) <p class="help-block">Select you position on map.</p> @endif
                    <textarea style="max-width: 100%;" class="form-control" rows="3" name="description" placeholder="Description">{{old('description')}}</textarea>
                        @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                    <input type="number" class="form-control"  min="1" name="capacity" placeholder="Enter capacity" value="{{old("capacity")}}">
                        @if ($errors->has('capacity')) <p class="help-block">{{ $errors->first('capacity') }}</p> @endif
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lon" id="lon">
                            </fieldset>
                        </div>
                   </div>
                   <br>



                    <div class="row">

                        <div class="col-md-2"></div>
                        <center>
                        <div class="col-md-4">
                            <a href="/" class="btn btn-danger hvr-grow">back</a>
                        </div>
                        <div class="col-md-4">
                            <input type="submit" class="btn btn-info hvr-grow" value="Register">
                        </div>
                        </center>
                    </div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>

    </div>
@endsection
@section("footer")
    <script>
        var currLat;
        var currLon;
        if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    currLat = position.coords.latitude;
                   currLon = position.coords.longitude;

                }, function() {

                });
            } else {
                // Browser doesn't support Geolocation

            }

        var marker;

        function initialize() {
            var mapCanvas = document.getElementById('map');
            var mapOptions = {
                center: new google.maps.LatLng(currLat, currLon),
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

                var lat = event.latLng.lat();
                var lng = event.latLng.lng();

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