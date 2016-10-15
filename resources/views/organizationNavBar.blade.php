@extends("master")
<div class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/organization"> <img style="height: 100%;" class="hvr-grow" src="http://brunchhubtest.com/images/logo.png"> </a>
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