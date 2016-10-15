<?php

namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\LocationModel;
use App\User;
use App\NewsModel;
use App\FamilyModel;
use App\RequestModel;
use App\HostedModel;
use App\OrganizationModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->beforeFilter(function(){
            if(!Session::get("user"))
            {
                if(Session::get("organization"))
                {
                    return redirect("organization");
                }
                else
                {
                    return redirect("/");
                }
            }
        });
    }
    public function index()
    {

        $family ="";
        $trueFamily="";
        $requests = "";

        $family = FamilyModel::where("id_user1", Session::get("user")->id)->orWhere("id_user2", Session::get("user")->id)->get();
        for($i=0;$i<count($family); $i++)
        {
            if($family[$i]["id_user1"] ==  Session::get("user")->id)
            {
                $trueFamily[$i] = User::where("id", $family[$i]["id_user2"])->first();
            }
            else
                $trueFamily[$i] = User::where("id", $family[$i]["id_user1"])->first();
        }

        $requestsId = RequestModel::where("id_user", Session::get("user")->id)->get();
        for($i=0;$i<count($requestsId); $i++)
        {
            $requests[$i] = OrganizationModel::where("id", $requestsId[$i]["id_org"])->first();
        }
        $acceptC =  HostedModel::where("user_id", Session::get("user")->id)->count();
        $news = NewsModel::orderBy("created_at",'desc')->take(10)->get();
        if($acceptC == 0) {
            return view("user")
                ->with("user", Session::get("user"))
                ->with("family", $trueFamily)
                ->with("requests", $requests)
                ->with("accCount", $acceptC)
                ->with("locs", LocationModel::where("user_id", Session::get("user")->id)->get())
                ->with("news",$news);
        }
        else
        {
            $hostid = HostedModel::where("user_id", Session::get("user")->id)->first();
            $host = OrganizationModel::where("id", $hostid->organization_id)->first();
            return view("user")
                ->with("user", Session::get("user"))
                ->with("family", $trueFamily)
                ->with("requests", $requests)
                ->with("host", $host)
                ->with("accCount", $acceptC)
                ->with("locs", LocationModel::where("user_id", Session::get("user")->id)->get())
                ->with("news",$news);
        }

    }
    public function become_friends()
    {
        $req = Request::all();
        $family = new FamilyModel();
        $family->id_user1 = $req["id1"];
        $family->id_user2 = $req["id2"];
        $family->save();
        return redirect("/userP/".$req["id2"]);

    }
    public  function search_index()
    {
        return view ("userSearch")->with("user", Session::get("user"))
            ->with("country",OrganizationModel::queryDB("SELECT DISTINCT country FROM organizations WHERE 1"))
            ->with("city",OrganizationModel::queryDB("SELECT DISTINCT city FROM organizations WHERE 1"))
            ->with("route","user/search");
    }
    public function user_index($id = null)
    {
        return view("userP");
    }
    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {

        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }

    public function send_req()
    {
        $req = Request::all();
        $request = new RequestModel();
        $request->id_user = $req["user_id"];
        $request->id_org = $req["organization_id"];
        $request->save();
        return redirect("/organization/".$req["organization_id"]);
    }

    public function get_locs()
    {
        $req = Request::all();
            $ret[0] = LocationModel::where("user_id", $req["id"])->get();
            $places = OrganizationModel::where("id", ">", 0)->get();
            $brojac = 0;
            for ($i = 0; $i < count($places); $i++) {
                if ($this->distance($req["lat"], $req["lon"], $places[$i]["lat"], $places[$i]["lon"], "K") < 100) {
                    $ret[1][$brojac] = $places[$i];
                    $brojac++;
                }
            }
            return $ret;

    }

    public function  arhive_loc(){
        $req = Request::all();
        $loc = new LocationModel();
        $loc->user_id = $req["id_user"];
        $loc->lat = $req["lat"];
        $loc->lon = $req["lon"];
        $loc->save();
        return redirect("/user");
    }
    public function logout()
    {
        Session::forget("user");
        return redirect('/');
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
    public function editt()
    {
        $req = Request::all();
        $user = User::where("id", $req["id"])->first();
        $user->name = $req["name"];
        $user->surname = $req["surname"];
        $user->birthdate = $req["birthday"];
        $user->country = $req["country"];
        $user->city = $req["city"];
        $user->address = $req["address"];
        $user->profession = $req["profession"];
        $user->illness = $req["illness"];
        $user->remember_token = "2";
        $user->update();
        Session::put("user", $user);
        return redirect("/user/account");
    }

    public function account()
    {
        return view("account")
            ->with("user", Session::get("user"));
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
