@extends("master")
@section("head")
    <link rel="stylesheet" href="../../../css/jquery.datetimepicker.css"/>
        <link rel="stylesheet" href="http://brunchhubtest.com/css/animate.css">
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
    var id= {{$user->id}};

            $(document).ready(function(){
                $("#home").addClass('active');
            });

    </script>
    <style>
        .news-section{
            height: 316px;
            overflow-y: scroll;
            overflow-x: hidden;
            margin-bottom: 50px;
        }
    </style>
@endsection
@section("content")
    @include("userNavBar")
    <div class="container">
    <div class="well animated fadeInDown">
        <div class="row news-section">
        @foreach($news as $new)
            <div class="col-md-12" style="margin-bottom: 20px">
                <div class="col-md-4">
                    <img src="http://brunchhubtest.com/images/{{$new->img_url}}" style="max-width: 100%;box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                </div>
                <div class="col-md-8">
                    <h3>{{$new->subject}}</h3>
                    <p>{{$new->text}}</p>
                </div>
                <div class="clearfix"></div>
            </div>
        @endforeach
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <div id="map" style="width: 100%; height: 300px; box-shadow: 0px 0px 7px 0px rgba(0,0,0,0.75);"></div>
            </div>
        </div>
        <center>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-4">
                <div> <h2>Family</h2></div>
                <ul class="list-group">
                    @if(!empty($family))
                @foreach($family as $f)
                       <li class="list-group-item familyItems info" style="cursor: hand; border-bottom: 1px solid; border-top: 1px solid;" id="{{$f->id}}"> {{$f->name}}</li>
                    @endforeach
                        @endif
                </ul>
            </div>
            <div class="col-md-4">

                <ul class="list-group">
                    @if($accCount >0)
                        <div class="row">
                            <h2>You're hosted at:</h2>
                            <h3><a href="/organization/{{$host->id}}">{{$host->name}}</a></h3>
                            <!-- <li class="list-group-item requestItems info" style="cursor: hand; border-bottom: 1px solid; border-top: 1px solid;">

                            </li> -->
                        </div>
                    @elseif(!empty($requests))
                        <div> <h2>Requests</h2></div>
               @foreach($requests as $r)
                 <li class="list-group-item requestItems info" style="cursor: hand; border-bottom: 1px solid; border-top: 1px solid;" id="{{$r->id}}"> {{$r->name}}</li>
                    @endforeach
                        @endif
                </ul>
            </div>
        </div>
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
        </center>

    </div>
    </div>
@endsection
@section("footer")
<script>
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
        var  marker = new google.maps.Marker({
            position: new google.maps.LatLng(currLat,currLon),
            map: map,
            icon: "../images/pin.png"
        });





    }
    $( document ).ready(function() {
        google.maps.event.addDomListener(window, 'load', initialize);
        setTimeout(function(){
            $.ajax({
                type:"POST",
                dataType:"json",
                url:"/get_locs",
                data: {
                    "_token": token,
                    "id":id,
                    "lat": currLat,
                    "lon": currLon
                },
                error:function (jqXHR, textStatus, errorThrown) {
                    //alert("error");
                },
                success: function (result) {
                    //alert(result[1].length);
                    google.maps.event.addDomListener(window, 'load', initialize);
                    for(var i=0; i<result[0].length; i++)
                    {

                        var myLatLng1 = {lat: parseFloat(result[0][i]["lat"]), lng: parseFloat(result[0][i]["lon"])};
                        var  marker2 = new google.maps.Marker({
                            position: myLatLng1,
                            map: map
                        });
                    }
                    for(var i=0; i<result[1].length; i++)
                    {
                        var myLatLng2 = {lat: parseFloat(result[1][i]["lat"]), lng: parseFloat(result[1][i]["lon"])};
                        var  marker3 = new google.maps.Marker({
                            position: myLatLng2,
                            map: map,
                            icon: "../images/pinorg.png",
                            title: result[1][i]["id"]
                        });
                        marker3.addListener('click', function() {

                            window.location = "/organization/" + $(this).attr("title");
                        });
                    }



                }
            });
        },2000)

    });

</script>
@endsection