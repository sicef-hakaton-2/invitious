@extends("master")

@section("content")
    <div class="container">
        <div class="well" style="margin-top: 50px">
        <form action="/admin/check" method="post" enctype="multipart/form-data">
        <div class="row" style="margin-top: 20px">
            <div class="col-md-4">Username:</div>
            <div class="col-md-4"><input type="text" class="form-control" name="username"></div>
        </div>
        <div class="row" style="margin-top: 50px">
            <div class="col-md-4">Password:</div>
            <div class="col-md-4"><input type="password" class="form-control" name="password"></div>
        </div>
            <button type="submit" class="btn btn-primary">Log in</button>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

        </form>
        </div>
    </div>
    @endsection