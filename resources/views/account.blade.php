@extends("master")
@section("head")
    <link rel="stylesheet" href="../../../css/jquery.datetimepicker.css"/>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <script>
            $(document).ready(function(){
                $("#profile").addClass('active');
            });

        </script>
@endsection
@section("content")
@include("userNavBar")

    <div class="container">
    <div class="well animated fadeInDown">

        @if($user->remember_token == 1)
            <div class="row">
        <form action="/user/edit" method="post" enctype="multipart/form-data">
        <div class="col-md-2"></div>
            <div class="col-md-4">

                @if($user->remember_token == 2 || $user->remember_token == 1)
                    <img src="{{$user->img_url}}"class="userProfileImg">
                @else
                    <img src="http://brunchhubtest.com/{{$user->img_url}}"class="userProfileImg">
                @endif

                @if($user->validation == 0)
                    <div style="color: darkred; padding-top: 10px; font-size: 20px"><span class="mdi-navigation-close"></span>&nbsp; <h3>Unvalidate user</h3></div>
                    @else
                    <div style="color: green; padding-top: 10px; font-size: 20px"><span class="mdi-navigation-check"></span>&nbsp; <h3>Valid user</h3></div>
                @endif
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">Username:</label></div>
                    <div class="col-md-8"><input type="text" class="form-control" value="{{$user->username}}"></div>
                </div>

                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">Name</label></div>
                    <div class="col-md-8"><input type="text" class="form-control" value="{{$user->name}}" name="name"></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">Surname:</label></div>
                    <div class="col-md-8"><input type="text" class="form-control" value="{{$user->surname}}" name="surname"></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">Birthdate:</label></div>
                    <div class="col-md-8"> <input type="text" class="form-control" id="open_date" name="birthday" class="form-control" value="{{$user->birthdate}}" >  </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">Country:</label></div>
                    <div class="col-md-8"><input type="text" class="form-control" value="{{$user->country}}" name="country"></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">City:</label></div>
                    <div class="col-md-8"><input type="text" class="form-control" value="{{$user->city}}" name="city"> </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">Address:</label></div>
                    <div class="col-md-8"><input type="text" class="form-control" value="{{$user->address}}" name="address"></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">Profession:</label></div>
                    <div class="col-md-8"><input type="text" class="form-control" value="{{$user->profession}}" name="profession"></div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">Illness:</label></div>
                    <div class="col-md-8"><input type="text" class="form-control" value="{{$user->illness}}" name="illness"> </div>
                </div>
                <div class="row">
                    <div class="col-md-4"><label class="control-label label1">Gender:</label></div>
                    <div class="col-md-8"><input type="text" class="form-control" value="{{$user->sex}}"></div>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary hvr-grow">Save changes</button>
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
            </div>
        </form>
            </div>
        @else
            @include("userProfile")
        @endif
        <div class="row">
            <div class="col-md-2"></div>

            <form action="/user/arhive_loc" method="post" enctype="multipart/form-data">

                <button type="submit" class="btn btn-success hvr-grow">Archive my location</button>
                <input type="hidden" value="{{$user->id}}" name="id_user">
                <input type="hidden" id="lat" value="{{$user->id}}" name="lat">
                <input type="hidden" id="lon" value="{{$user->id}}" name="lon">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

            </form>

        </div>
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
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                $("#lat").val(position.coords.latitude);
                $("#lon").val(position.coords.longitude);




            }, function() {
                alert(pos);
            });
        } else {
            // Browser doesn't support Geolocation

        }


    </script>
@endsection