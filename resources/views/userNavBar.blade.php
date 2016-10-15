
<div class="navbar navbar-inverse">
    <div class="container">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-inverse-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" style="font-size: 25px" href="javascript:void(0)"><img style="height: 100%;" class="hvr-grow" src="http://brunchhubtest.com/images/logo.png"></a>
    </div>
    <div class="navbar-collapse collapse navbar-inverse-collapse">
        <ul class="nav navbar-nav">
            <li class="label1 hvr-grow" id="home"><a  href="{{URL::route('user')}}">Home</a></li>
            <li class="label1 hvr-grow" id="profile"><a  href="/user/account">Profile</a></li>
            <li class="label1 hvr-grow" id="search"><a href="/user/searchIndex">Search</a></li>
            <li class="label1 hvr-grow" id="mia"><a href="/missingPersons">M.I.A.</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="label1 hvr-grow"><a href="/user/logout">Log out</a></li>
        </ul>

    </div>
    </div>
</div>
