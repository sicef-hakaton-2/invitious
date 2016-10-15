<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
            if(!Session::get("admin"))
            {
               return redirect("/");
            }
        });
    }
    public function index()
    {
        return view("admin_index")->with("users", "");
    }
    public function validateP()
    {
        $req = Request::all();
        $user = User::where("id", $req["id"])->first();
        $user->validation = 1;
        $user->update();
        return view("admin_index")->with("users", "");
    }

    public function search()
    {
        $req = Request::all();
        $users = User::where("validation", "=", 0)->where("name", "like", "%".$req["name"]."%")->orWhere("surname", "like", "%".$req["name"]."%")->get();
        return view("admin_index")->with("users", $users);

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
