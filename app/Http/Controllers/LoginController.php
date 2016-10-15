<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\User;
use App\OrganizationModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Socialize;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
            if(Session::get("user"))
            {
                return redirect("user");
            }
            else if(Session::get("organization"))
            {
                return redirect("organization");
            }
        });
    }
    public function index()
    {
        //
    }
    public function login()
    {
        $request = Request::all();
        $errors = Validator::make($request, [
            'username' => 'required|min:4|max:255',
            'password' => 'required',
        ]);
        if($errors->fails())
        {
            return redirect("/")->withErrors($errors)->withInput();
        }
        else
        {
            $password = hash('sha256',$request["password"]);
            $organization = OrganizationModel::where("username",$request["username"])
                ->where("password",$password)->first();
            if($organization)
            {
                Session::put('organization',$organization);
                return redirect('organization');
            }
            else
            {
                $user = User::where("username",$request['username'])
                    ->where("password",$password)->first();
                if($user)
                {
                    Session::put('user',$user);
                    return redirect('user');
                }
                else
                {
                    return redirect('/');
                }
            }
        }
    }
    public function facebook(){
        return Socialize::with("facebook")->redirect();
    }
    public function facebook_check(){
        $social_user = Socialize::with('facebook')->user();
        if($social_user)
        {
            $check_user = User::where("username","fb_".$social_user->id)->first();
            if($check_user)
            {
                $check_user->img_url = $social_user->avatar;
                $check_user->update();
                Session::put("user",$check_user);
                return redirect('user');
            }
            else
            {
                $user = new User();
                $user->username = "fb_".$social_user->id;
                $user->name = $social_user->user["first_name"];
                $user->surname = $social_user->user["last_name"];
                $user->sex = $social_user->user["gender"];
                $user->password = hash('sha256',"null");
                $user->img_url = $social_user->avatar;
                $user->remember_token = 1;
                $user->save();
                Session::put('user',$user);
                return redirect('user/account');
            }
        }
        else
        {
            return redirect("register");
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
