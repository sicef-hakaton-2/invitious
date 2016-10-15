<html>
<head>
    <title>Reforg</title>
    <link rel="stylesheet" href="http://brunchhubtest.com/css/bootstrap.css">
    <link rel="stylesheet" href="http://brunchhubtest.com/css/material.min.css">
    <link rel="stylesheet" href="http://brunchhubtest.com/css/roboto.min.css">
    <link rel="stylesheet" href="http://brunchhubtest.com/css/hover-min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://brunchhubtest.com/js/bootstrap.js"></script>
    <script src="http://brunchhubtest.com/js/material.js"></script>
    <script src="http://brunchhubtest.com/js/ripples.js"></script>
    <script src="http://brunchhubtest.com/js/jquery-ui.js"></script>

    @yield('head')
</head>
<body>

<div id="wrapper">

        <div class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/organization"><img style="height: 100%;" class="hvr-grow" src="http://brunchhubtest.com/images/logo.png"></a>
                </div>
                <div class="navbar-collapse collapse navbar-inverse-collapse">
                    <ul class="nav navbar-nav">
                        <li id="home" class="hvr-grow"><a href="{{URL::route('organization')}}">Home</a></li>
                        <li id="profile" class="hvr-grow"><a href="{{URL::route('organization/account')}}">Profile</a></li>
                        <li id="requests" class="hvr-grow"><a href="/organization/requests">Requests</a></li>
                        <li id="hosted" class="hvr-grow"><a href="/organization/hosted">Hosted</a></li>
                        {{--<li id="news" class="hvr-grow"><a href="/organizations/news">News</a></li>--}}
                        <li id="missing" class="hvr-grow"><a href="/missingPersons">Missing Persons</a></li>
                        <li id="search" class="hvr-grow"><a href="/organizations/search">Search</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right hvr-grow">
                        <li><a href="{{URL::route('organization/logout')}}">Log out</a></li>

                    </ul>


                </div>
            </div>
        </div>


    <div id="page-wrapper">

        <div class="container-fluid">
            @yield('content')
        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
@yield('footer')
</body>
</html>