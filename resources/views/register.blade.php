@extends("master")
@section("head")
    <meta name="viewport" content="width=device-width, initial-scale=1.2">
    <link rel="stylesheet" href="../../../css/jquery.datetimepicker.css"/>

@endsection
@section("content")

                <ul class="nav nav-tabs navbar navbar-inverse" style="">
                    <li style="width: 50%; font-size: 25px; font-family: 'Roboto', sans-serif; margin-top: 5px"><a href="{{URL::route('register/user')}}" class="btn btn-default">Refugee</a></li>
                    <li style="width: 50%; font-size: 25px; font-family: 'Roboto', sans-serif; margin-top: 5px"><a href="{{URL::route('register/organization')}}" class="btn btn-default">Organization</a></li>
                </ul>

    <div class="container">


        <div class="row">

            <div class="row regRef">
                <div class="col-md-2"></div>
                <center>
                <div class="col-md-8 well animated fadeInDown">
            <form method="post" action="{{URL::route('register/user/check')}}" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-2"></div>
                    <center>
                    <div class="col-md-8">
                        <h2 style="font-size: 25px; font-family: 'Roboto', sans-serif;">Refugee register</h2>
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
                <input type="text" class="form-control"  name="surname" placeholder="Enter surname" value="{{old('surname')}}">
                    @if ($errors->has('surname')) <p class="help-block">{{ $errors->first('surname') }}</p> @endif
                <input type="text" id="open_date" name="birthdate" class="form-control" value="" placeholder="Enter date of birth:" value="{{old('birthdate')}}">
                    @if ($errors->has('birthdate')) <p class="help-block">{{ $errors->first('birthdate') }}</p> @endif
                <input type="text" class="form-control"  name="country" placeholder="Enter country" value="{{old('country')}}">
                    @if ($errors->has('country')) <p class="help-block">{{ $errors->first('country') }}</p> @endif
                <input type="text" class="form-control"  name="city" placeholder="Enter city" value="{{old('city')}}">
                    @if ($errors->has('city')) <p class="help-block">{{ $errors->first('city') }}</p> @endif
                <input type="text" class="form-control"  name="address" placeholder="Enter address" value="{{old('address')}}">
                    @if ($errors->has('address')) <p class="help-block">{{ $errors->first('address') }}</p> @endif
                <select class="form-control" name="sex" id="select">
                    <option value="" disabled selected>Select gender</option>
                    <option value="male" {{ (old('sex') == 'male') ? 'selected="selected"' : null }}>Male</option>
                    <option value="female" {{ (old('sex') == 'memale') ? 'selected="selected"' : null }}>Female</option>
                </select>
                    @if ($errors->has('sex')) <p class="help-block">{{ $errors->first('sex') }}</p> @endif
                <input type="text" class="form-control"  name="profession" placeholder="Enter profession" value="{{old('profession')}}">
                    @if ($errors->has('profession')) <p class="help-block">{{ $errors->first('profession') }}</p> @endif
                <input type="text" class="form-control"  name="illness" placeholder="Enter health state" value="{{old('illness')}}">
                    @if ($errors->has('illness')) <p class="help-block">{{ $errors->first('illness') }}</p> @endif
                <br><span>Profile picture: &nbsp;</span><input type="file" id="inputFile" multiple="" name="img_url" placeholder="Profile picture">
                    @if ($errors->has('img_url')) <p class="help-block">{{ $errors->first('img_url') }}</p> @endif


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
                        <button type="submit" class="btn btn-info hvr-grow">Register</button>
                    </div>
                    </center>
                </div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
                </div>
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

    </script>
@endsection