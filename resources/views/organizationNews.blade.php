@extends("master-admin")
@section("head")
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
        $(document).ready(function(){
            $("#news").addClass('active');
        });

    </script>
@endsection
@section("content")
    <div class="container well">
        <center><a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Add new news
        </a></center>
        <div class="collapse" id="collapseExample">
            <div class="well">
                <form class="form-horizontal" method="post" action="http://brunchhubtest.com/organization/news/save" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputEmail" class="col-lg-2 control-label">Subject</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="subject" id="inputEmail" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="desc" class="col-lg-2 control-label">Description</label>
                        <div class="col-md-10" id="desc">
                            <textarea class="form-control" rows="3" name="text"  placeholder="Description" style="max-width: 100%"></textarea>

                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputFile" class="col-lg-2 control-label">File</label>
                        <div class="col-lg-10">
                            <input type="file" name="img_url" id="inputFile" multiple="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-lg-offset-2">
                            <a class="btn btn-default" >Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
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
        <center>{!! $pagination !!}</center>
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