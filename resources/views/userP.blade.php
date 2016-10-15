
@extends("master")
@section("head")
    <link rel="stylesheet" href="../../../css/jquery.datetimepicker.css"/>
        <link rel="stylesheet" href="http://brunchhubtest.com/css/animate.css">
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
    var id= {{$userP->id}};

            $(document).ready(function(){
                $("#home").addClass('active');
            });

    </script>

@endsection
@section("content")
    @if(!empty($user))
    @include("userNavBar")
        @else
        @include("organizationNavBar")
    @endif
    <div class="container">
        <div class="well animated fadeInDown">

            <link rel="stylesheet" href="../../../css/userProfile.css"/>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    @if($userP->remember_token == 2 || $userP->remember_token == 1)
                        <img src="{{$user->img_url}}"class="userProfileImg">
                    @else
                        <img src="http://brunchhubtest.com/{{$userP->img_url}}"class="userProfileImg">
                    @endif
                    @if($userP->validation == 0)
                        <div>Unvalidate user</div>
                    @else
                        <div>Valid user</div>
                    @endif
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">Username:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->username}}" disabled=""></div>
                    </div>

                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">Name:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->name}}" disabled=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">Surname:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->surname}}" disabled=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">Birthdate:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->birthdate}}" disabled=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">Country:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->country}}" disabled=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">City:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->city}}" disabled=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">Address:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->address}}" disabled=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">Profession:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->profession}}" disabled=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">Illness:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->illness}}" disabled=""></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4"><label class="control-label label1">Gender:</label></div>
                        <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$userP->sex}}" disabled=""></div>
                    </div>
                </div>
            </div>
            @if(!empty($user) && $friends!="t")
            <div class="row">
                <div class="col-md-4">
                    <form action="/user/friend" method="post" enctype="multipart/form-data">

                        <button type="submit" class="btn btn-success">Become family</button>
                        <input type="hidden" id="id_1" value="{{$user->id}}" name="id1">
                        <input type="hidden" id="I" value="{{$userP->id}}" name="id2">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    </form>
                </div>
                <div class="col-md-8">
                    <div id="map" style="width: 100%; height: 300px; box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.75);"></div>
                </div>

            </div>
                @elseif(!empty($user) && $friends=="t")
                <div class="row">
                    <div class="col-md-4">
                        Family member
                    </div>
                    <div class="col-md-8">
                        <div id="map" style="width: 100%; height: 300px; box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.75);"></div>
                    </div>
                </div>
                @endif
                <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
        </div>
    </div>
@endsection
@section("footer")
    <script src="../../../js/jquery.datetimepicker.full.min.js"></script>
    <script>
        $('#open_date').datetimepicker({
            format: 'd/m/Y',
            minView: 2,
            showTimepicker: false
        });
        $(".familyItems").click(function() {
                window.location = "/userP/" + $(this).attr("id");
            });
            $(".requestItems").click(function() {
                window.location = "/organization/" + $(this).attr("id");
            });
            var token = $("#token").val();
            var currLat;
            var currLon;
            // Try HTML5 geolocation.
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    currLat = position.coords.latitude;
                   currLon = position.coords.longitude;

                }, function() {

                });
            } else {
                // Browser doesn't support Geolocation

            }
            var map;
            function initialize() {
                var mapCanvas = document.getElementById('map');
                var mapOptions = {
                    center: new google.maps.LatLng(currLat,currLon),
                    zoom: 12,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }

                map = new google.maps.Map(mapCanvas, mapOptions);
                /*var  marker = new google.maps.Marker({
                    position: new google.maps.LatLng(currLat,currLon),
                    map: map,
                    icon: "../images/pin.png"
                });*/





            }
            $( document ).ready(function() {
                google.maps.event.addDomListener(window, 'load', initialize);
                setTimeout(function(){
                    $.ajax({
                        type:"POST",
                        dataType:"json",
                        url:"/users/get/locations/find/load",
                        data: {
                            "_token": token,
                            "id":id
                        },
                        error:function (jqXHR, textStatus, errorThrown) {
                            //alert("error");
                        },
                        success: function (result) {
                            //alert(result[1].length);
                            google.maps.event.addDomListener(window, 'load', initialize);

                            for(var i=0; i<result.length; i++)
                            {
                                var myLatLng2 = {lat: parseFloat(result[i]["lat"]), lng: parseFloat(result[i]["lon"])};
                                var  marker3 = new google.maps.Marker({
                                    position: myLatLng2,
                                    map: map,
                                    icon: "../images/pinorg.png",
                                    title: result[i]["updated_at"]
                                });
                                marker3.addListener('click', function() {
                                    var infowindow = new google.maps.InfoWindow({
                                        content: this.title
                                      });
                                    infowindow.open(map, this);
                                });
                            }



                        }
                    });
                },2000)

            });



    </script>
@endsection