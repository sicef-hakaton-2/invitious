<head>
<link rel="stylesheet" href="http://brunchhubtest.com/css/animate.css">
</head>



<div class="container well animated fadeInDown" style="margin-top: 50px;">
    <div class="col-md-8 col-md-offset-2" style="margin-top: 100px; margin-bottom: 100px">
        <form method="get" action="/{{$route}}">
            <input type="text" placeholder="Name, Address" name="search" class="form-control">
            <select class="form-control" name="search_for" id="select">
                <option value="organization">Search for</option>
                <option value="organization">Organization</option>
                <option value="refugees">Refuges</option>
            </select>
            <select class="form-control" name="country" id="select">
                <option value="0">Country</option>
                @foreach($country as $c)
                    <option value="{{$c->country}}">{{$c->country}}</option>
                @endforeach
            </select>

            <select class="form-control" name="city" id="select">
                <option value="0">City</option>
                @foreach($city as $c)
                    <option value="{{$c->city}}">{{$c->city}}</option>
                @endforeach
            </select>

            <div class="form-group" style="margin-top: 30px">
                <div class="col-lg-10 text-center">
                    <a class="btn btn-default" href="/">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Search">
                </div>
            </div>

        </form>
    </div>
</div>