@extends("master")
@section("head")
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../../css/jquery.datetimepicker.css"/>
    <script src="https://maps.googleapis.com/maps/api/js"></script>
    <link rel="stylesheet" href="../../../css/index.css"/>
    <link href='https://fonts.googleapis.com/css?family=Roboto:100' rel='stylesheet' type='text/css'>
    <script>
        $(document).ready(function () {
            var height = $(window).height();
            var margin = height - 250 - $(".linkovi").height() - $(".slogan").height() - 10;
            $('.linkovi').css('margin-top', margin);
        });
        $(window).resize(function () {
            var height = $(window).height();
            var margin = height - 250 - $(".slogan").height() - 10;
            $('.linkovi').css('margin-top', margin);
        });
    </script>

@endsection
@section("content")
    <html style="overflow:hidden;">
    <div class="bg"></div>
    <div class="navbar navbar-inverse mobNav">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="javascript:void(0)">Brand</a>
        </div>
        <div class="navbar-collapse collapse navbar-inverse-collapse">
            <ul class="nav navbar-nav">
                <li><a href="javascript:void(0)" class="dntBtn">Donate</a></li>
                <li><a href="javascript:void(0)" class="missBtn">Report Missing</a></li>
                <li><a href="javascript:void(0)" class="regBtn">Register</a></li>
                <li><a id="login_btn" data-toggle="modal"
                       data-target="#login1">Login</a></li>
            </ul>

        </div>

    </div>
    <div class="container">

        <div class="row kon1 animated fadeInDown">
            <div class="col-md-8">
                <form class="navbar-form" method="get" action="search">
                    <input type="text" class="form-control col-lg-8 toprow" placeholder="Search" name="search">
                </form>
            </div>
            <div class="col-md-4">
                <img class="logo" src="../../../images/logo.png">
            </div>

        </div>
        <div class="row mobL">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <img  class="logoMM" src="../../../images/logo.png">
            </div>
            <div class="col-sm-2"></div>
        </div>
        <div class="element">

            <div class="row">
                <center>

                    <p class="slogan animated zoomIn">Hope is the only bee that makes honey without flowers.</p>

                </center>
            </div>

            <div class="row">


                <div class="modal animated bounceInDown" style="animation-duration: 1s !important;" id="login1">
                    <div class="modal-dialog">
                        <div class="modal-content" style="margin-top: 70px;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                <center><p class="modal-title linkovi2">Login</p></center>
                            </div>
                            <div class="modal-body" style="margin-top: 20px;">
                                <form class="navbar-form" action="/login" method="post">
                                    <center>
                                        <div class="row">
                                            <div class="col-md-4" style="height: 34px; "><label for="inputEmail"
                                                                                                class="control-label linkovi2">Username: </label>
                                            </div>
                                            <div class="col-md-8" style="color: black !important;">
                                                <input class="form-control linkovi2" type="text" name="username"
                                                       placeholder="Username">
                                            </div>
                                        </div>
                                        <br>

                                        <div class="row">
                                            <div class="col-md-4" style="height: 34px"><label for="inputEmail"
                                                                                              class="control-label linkovi2">Password: </label>
                                            </div>
                                            <div class="col-md-8" style="color: black !important;">
                                                <input class="form-control linkovi2" type="password" name="password"
                                                       placeholder="Password">
                                            </div>
                                        </div>

                                        <br><br>

                                        <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-8" style="font-size: 20px; color: white">Login via: <a
                                                        href="/login/facebook"><span
                                                            style="color: #008fed">facebook</span></a></div>
                                        </div>
                                        <br><br>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" class="btn btn-success hvr-grow">Log in</button>

                                            </div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-danger btn-raised hvr-grow"
                                                        data-dismiss="modal">Close
                                                </button>
                                            </div>
                                        </div>

                                    </center>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row kon1 linkovi animated fadeInUp">
                <center>
                    <div class="col-md-3">
                        <div class="hvr-grow hvr-underline-from-center dntBtn" style="cursor: hand">Donate</div>
                    </div>
                    <div class="col-md-4">
                        <div class="hvr-grow hvr-underline-from-center missBtn" style="cursor: hand">Report missing
                            person
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="hvr-grow hvr-underline-from-center"><a id="login_btn" data-toggle="modal"
                                                                           data-target="#login1">Login</a></div>
                    </div>
                    <div class="col-md-3">
                        <div class="hvr-grow hvr-underline-from-center regBtn" style="cursor: hand">Register</div>
                    </div>
                </center>
            </div>


        </div>

        <script>
            $(".missBtn").click(function () {
                window.location = "/missingPersons";
            });
            $(".regBtn").click(function () {
                window.location = "/register/user";
            });$(".dntBtn").click(function () {
                window.location = "/donate";
            });
        </script>
    </div>
    </html>
@endsection