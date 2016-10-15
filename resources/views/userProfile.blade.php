<link rel="stylesheet" href="../../../css/userProfile.css"/>
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-4">
        @if($user->remember_token == 2 || $user->remember_token == 1)
            <img src="{{$user->img_url}}"class="userProfileImg">
        @else
            <img src="http://brunchhubtest.com/{{$user->img_url}}"class="userProfileImg">
        @endif
        @if($user->validation == 0)
            <div>Unvalidate user</div>
        @else
            <div>Valid user</div>

        @endif
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="col-md-4"><label class="control-label label1">Username:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->username}}" disabled=""></div>
        </div>

         <div class="row">
            <div class="col-md-4"><label class="control-label label1">Name:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->name}}" disabled=""></div>
        </div>
         <div class="row">
            <div class="col-md-4"><label class="control-label label1">Surname:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->surname}}" disabled=""></div>
        </div>
         <div class="row">
            <div class="col-md-4"><label class="control-label label1">Birthdate:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->birthdate}}" disabled=""></div>
        </div>
         <div class="row">
            <div class="col-md-4"><label class="control-label label1">Country:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->country}}" disabled=""></div>
        </div>
        <div class="row">
            <div class="col-md-4"><label class="control-label label1">City:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->city}}" disabled=""></div>
        </div>
        <div class="row">
            <div class="col-md-4"><label class="control-label label1">Address:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->address}}" disabled=""></div>
        </div>
         <div class="row">
            <div class="col-md-4"><label class="control-label label1">Profession:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->profession}}" disabled=""></div>
        </div>
         <div class="row">
            <div class="col-md-4"><label class="control-label label1">Illness:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->illness}}" disabled=""></div>
        </div>
         <div class="row">
            <div class="col-md-4"><label class="control-label label1">Gender:</label></div>
            <div class="col-md-8"><input class="form-control" id="disabledInput" type="text" placeholder="{{$user->sex}}" disabled=""></div>
        </div>
    </div>
</div>