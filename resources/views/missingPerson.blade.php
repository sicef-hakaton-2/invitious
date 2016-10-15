@extends("master")
@section("head")
    <link rel="stylesheet" href="../../../css/jquery.datetimepicker.css"/>
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
    <div class="container well">
        <center><a class="btn btn-primary" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                Add new missing person
            </a></center>
        <div class="collapse" id="collapseExample">
            <div class="">
                <form class="form-horizontal" method="post" action="http://brunchhubtest.com/addMissingPerson" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name" class="col-lg-2 control-label">Name</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="surname" class="col-lg-2 control-label">Surname</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control" name="surname" id="surname" placeholder="Surname">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="open_date" class="col-lg-2 control-label">Birthdate</label>
                        <div class="col-lg-10">
                            <input type="text" id="open_date" name="birthdate" class="form-control" value="" placeholder="Enter date of birth:" value="{{old('birthdate')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="select" class="col-lg-2 control-label">Select gender</label>
                        <div class="col-lg-10">
                        <select class="form-control" name="sex" id="select">
                            <option value="" disabled selected>Select gender</option>
                            <option value="male" {{ (old('sex') == 'male') ? 'selected="selected"' : null }}>Male</option>
                            <option value="female" {{ (old('sex') == 'memale') ? 'selected="selected"' : null }}>Female</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="country" class="col-lg-2 control-label">Country</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control"  id="country" name="country" placeholder="Enter country" value="{{old('country')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city1" class="col-lg-2 control-label">City</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control"  name="city" id="city1" placeholder="Enter city" value="{{old('city')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="city2" class="col-lg-2 control-label">Address</label>
                        <div class="col-lg-10">
                            <input type="text" class="form-control"  id="city2" name="address" placeholder="Enter address" value="{{old('address')}}">
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
                            <a class="btn btn-default" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="true">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>
    @foreach($person as $person)
        <div class="container well">
            <div class="col-md-12" style="margin-bottom: 20px">
                <div class="col-md-4">
                    <img src="http://brunchhubtest.com/images/{{$person->img_url}}" style="max-width: 100%;box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);">
                </div>
                <div class="col-md-8">
                    <form class="form-horizontal">
                        <fieldset>
                            <legend>Missing Person</legend>
                            <div class="form-group">
                                <label for="firstName" class="col-lg-2 control-label">Name</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="firstName" placeholder="Name" disabled value="{{$person['name']}}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="select" class="col-lg-2 control-label">Surname</label>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" id="firstName" placeholder="Name" disabled value="{{$person->surname}}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="country" class="col-lg-2 control-label" >Male</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="country" placeholder="Country" disabled value="{{$person->sex}}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="city" class="col-lg-2 control-label">Birthate</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="city" placeholder="dd/mm/YY" disabled value="{{$person->birthdate}}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-lg-2 control-label">Country</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="address" placeholder="Address" disabled value="{{$person->country}}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-lg-2 control-label">City</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="address" placeholder="Address" disabled value="{{$person->city}}">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="col-lg-2 control-label">Address</label>
                                <div class="col-lg-10">
                                    <input type="text" class="form-control" id="address" placeholder="Address" disabled value="{{$person->address}}">

                                </div>
                            </div>

                            <input type="hidden" name="id">


                        </fieldset>
                    </form>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    @endforeach
    <center>{!! $pagination !!}</center>
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