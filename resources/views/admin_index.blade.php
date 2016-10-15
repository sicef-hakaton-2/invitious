@extends("master")
<style>
    .img-width-100{
        max-width: 150px;
        max-height: 200px;
        min-width: 150px;
    }
</style>
@section("content")
    <div class="container">
        <div class="well" style="margin-top: 50px">
        <form action="/admin/search" method="post" enctype="multipart/form-data">
        <div class="row" style="margin-top: 20px; max-height: 50px; margin-bottom: 40px">
            <div class="col-md-1"></div>
            <div class="col-md-3" ><div style="margin-top: 11px">Search Name:</div></div>
            <div class="col-md-5"> <input style="margin-top: 7px; width: 400px;" type="text" name="name" ></div>
            <div class="col-md-2"> <button type="submit" class="btn btn-primary" style="margin: 0px; "><span class="mdi-action-search"></span></button></div>
        </div>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

        </form>
        @if(!empty($users))
            <table class="table table-striped table-hover ">
                <tr><th></th><th>Name</th><th>Surname</th><th>Id</th><th></th></tr>
            @foreach($users as $u)
                <tr>
                    <form action="/admin/validate" method="post" enctype="multipart/form-data">
                    <td>
                    @if($u->remember_token == 2 || $u->remember_token == 1)
                        <img style="margin-left: 10px" src="{{$u->img_url}}">
                    @else
                        <img style="margin-left: 10px" src="/images/{{$u->img_url}}" class="img-width-100">
                    @endif
                    </td>
                    <td>{{$u->name}}</td>
                        <td>{{$u->surname}}</td>
                    <td>{{$u->id}}</td>
                    <td><button type="submit" class="btn btn-primary">Validate</button></td>
                        <input type="hidden" name="id" value="{{ $u->id }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    </form>
                </tr>
                @endforeach
                </table>
            @endif
    </div>

    </div>
@endsection