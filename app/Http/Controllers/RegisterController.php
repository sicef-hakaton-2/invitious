<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use App\User;
use App\OrganizationModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
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
                return redirect("user/".Session::get("user")->id);
            }
            else if(Session::get("organization"))
            {
                return redirect("organization/".Session::get("organization")->id);
            }
        });
    }
    public function index()
    {
        //
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
    public function register_user()
    {
        $request = Request::all();
        $errors = Validator::make($request, [
            'username' => 'required|min:4|max:255|unique:users|unique:organizations',
            'password' => 'required|min:6',
            'name' => 'required|min:4|max:255',
            'surname' => 'required|min:4|max:255',
            'birthdate' => 'required|min:10',
            'country' => 'required|min:2|max:255',
            'city' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'profession' => 'required|min:2|max:255',
            'illness' => 'required|min:2|max:255',
            'sex' => 'required|min:2|max:255',
            'img_url' => 'required',
        ]);
        if ($errors->fails()) {
            return redirect("register/user")->withErrors($errors->messages())->withInput();
        }
        else
        {
            $user = new User();
            $user->username = $request["username"];
            $user->password = hash('sha256',$request["password"]);
            $user->name = $request["name"];
            $user->surname = $request["surname"];
            $user->birthdate = substr($request["birthdate"], 6, 4) . "-" . substr($request["birthdate"], 5, 2) . "-" . substr($request["birthdate"], 8, 2);
            $user->country = $request["country"];
            $user->city = $request["city"];
            $user->address = $request["address"];
            $user->profession = $request["profession"];
            $user->illness = $request["illness"];
            $user->sex = $request["sex"];
            Request::file('img_url')->move('images', $request["username"].'.jpg');
            $user->img_url = "images/".$request["username"].'.jpg';
            $user->save();
            Session::put('user',$user);
            return redirect('user');
        }
    }

    public function register_organizations()
    {
        $request = Request::all();
        $errors = Validator::make($request, [
            'username' => 'required|min:4|max:255|unique:organizations|unique:users',
            'password' => 'required|min:6',
            'name' => 'required|min:4|max:255',
            'type' => 'required|min:4|max:255',
            'country' => 'required|min:2|max:255',
            'city' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'lat' => 'required|min:1|max:255',
            'lon' => 'required|min:1|max:255',
            'email' => 'required|email|unique:organizations',
            'description' => 'required|min:2|max:1000',
            'capacity' => 'required',
        ]);
        if ($errors->fails()) {
            return redirect("register/organization")->withErrors($errors->messages())->withInput();
        }
        else
        {
            $organization = new OrganizationModel();
            $organization->username = $request["username"];
            $organization->password = hash('sha256',$request["password"]);
            $organization->name = $request["name"];
            $organization->type = $request["type"];
            $organization->email = $request['email'];
            $organization->country = $request["country"];
            $organization->city = $request["city"];
            $organization->address = $request["address"];
            $organization->lat = $request["lat"];
            $organization->lon = $request["lon"];
            $organization->description = $request["description"];
            $organization->capacity = $request["capacity"];
            $organization->reserved = 0;
            $organization->save();
            Session::put('organization',$organization);
            return redirect('organization');
        }
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
