@extends("master-admin")
@section("head")
<link rel="stylesheet" href="http://brunchhubtest.com/css/animate.css">
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
        $(document).ready(function(){
            $("#profile").addClass('active');
        });

    </script>
@endsection
@section("content")
    <div class="col-md-8 col-md-offset-2 well animated fadeInDown">
        <div class="col-md-3">
            <img style="box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);" src="http://brunchhubtest.com/images/org.jpg">
        </div>
        <div class="col-md-9">
            <form class="form-horizontal" method="post" action="{{URL::route('organization/account/update')}}">
                <fieldset>
                    <legend>Account</legend>
                    <div class="form-group">
                        <label for="firstName" class="col-lg-2 control-label">Username</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="firstName" placeholder="Username" name="username" value="{{$organization->username}}">
                            @if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-lg-2 control-label">Password</label>
                        <div class="col-lg-10">
                            <input type="password" class="form-control" id="password" placeholder="Password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="firstName" class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="firstName" placeholder="Name" name="name" value="{{$organization->name}}">
                            @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email" class="col-lg-2 control-label">Email</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="email" placeholder="Email" name="email" value="{{$organization->email}}">
                            @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Type</label>
                        <div class="col-md-10">
                            <select class="form-control col-md-10" name="type" id="select">
                                <option value="" disabled @if ($organization->type=="") @endif>Select type</option>

                                <option value="reception center"  @if ($organization->type=="reception center") selected @endif>Recepcion Center</option>
                                <option value="private accommodation" @if ($organization->type=="private accommodation") selected @endif>Private accommodation</option>
                                <option value="kitchen" @if ($organization->type=="kitchen") selected @endif>Kitchen</option>
                            </select>
                            @if ($errors->has('type')) <p class="help-block">{{ $errors->first('type') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="col-lg-2 control-label" >Country</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{$organization->country}}">
                            @if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city" class="col-lg-2 control-label">City</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="city" placeholder="City" name="city" value="{{$organization->city}}">
                            @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="address" class="col-lg-2 control-label">Address</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" id="address" placeholder="Address" name="address" value="{{$organization->address}}">
                            @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc" class="col-lg-2 control-label">Description</label>
                        <div class="col-md-10" id="desc">
                            <textarea class="form-control" rows="3" name="description" placeholder="Description">{{$organization->description}}</textarea>
                            @if ($errors->has('description')) <p class="help-block">{{ $errors->first('description') }}</p> @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="capacity" class="col-lg-2 control-label">Capacity</label>
                        <div class="col-md-10" id="capacity">
                            <input type="number" class="form-control"  min="1" name="capacity" placeholder="Enter capacity" value="{{$organization->capacity}}">
                            @if ($errors->has('capacity')) <p class="help-block">{{ $errors->first('capacity') }}</p> @endif
                        </div>
                    </div>
                    <input type="hidden" name="lat" id="lat">
                    <input type="hidden" name="lon" id="lon">
                    <input type="hidden" name="id">
                    <div class="col-md-11 col-md-offset-1">
                        <div id="map" style="width: 100%;height: 300px; box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);"></div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <button class="btn btn-default">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                </fieldset>
            </form>
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