<?php

namespace App\Http\Controllers;

use Request;
use App\OrganizationModel;
use App\User;
use App\MissingPersonModel;
use App\RequestModel;
use App\HostedModel;
use App\FamilyModel;
use App\LocationModel;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index');
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

    public function viewProfile($id = null){
        if($id){
            if( Session::get("user")){
            $organization = OrganizationModel::where("id", $id)->first();
            $requestC =  RequestModel::where("id_user", Session::get("user")->id)->where("id_org", $id)->count();
            $acceptC =  HostedModel::where("user_id", Session::get("user")->id)->count();
            return view("organizationView")
                ->with("organization",$organization)
                ->with("reqCount",$requestC)
                ->with("accCount",$acceptC)
                ->with('user',Session::get("user"));
            }
            else{
                $organization = Session::get("organization");
                return view("organizationView")
                    ->with("organization",$organization);

            }
        }
    }

    public function admin()
    {
        return view("admin_login");
    }

    public function register_user()
    {
        return view("register");
    }
    public function register_organization()
    {
        return view("register_org");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function admin_check()
    {
        $req = Request::all();
        if($req["username"] == "admin" && $req["password"]=="admin")
        {
            Session::put("admin", "true");
            return view("admin_index");
        }
        else
        {
            return redirect("/");
        }
    }
    public function user_index($id = null)
    {
        if(Session::get("organization"))
        {
            $user = User::where("id", $id)->first();
            return view("userP")
                ->with("organization", Session::get("organization"))
                ->with("userP", $user);
        }
        else if(Session::get("user"))
        {
            if(Session::get("user")->id == $id)
            {
                return redirect("/user/account");
            }
            $user = User::where("id", $id)->first();
            $friends = "f";
            $count1 = FamilyModel::where("id_user1", $id)->where("id_user2", Session::get("user")->id)->count();
            $count2 = FamilyModel::where("id_user2", $id)->where("id_user1", Session::get("user")->id)->count();


            if($count1 >0 || $count2>0)
            {
                $friends = "t";
            }
            return view("userP")
                ->with("userP", $user)
                ->with("friends", $friends)
                ->with("user", Session::get("user"));
        }
        else
        {
            return redirect("/");
        }

    }
    public function getAllLocations(){
        $requests = Request::all();
        $id = $requests["id"];
        $locations = LocationModel::where("user_id",$id)->orderBy('updated_at', 'desc')->get();

        return $locations;
    }
    public function missingPersons($page = null){
        $restaurants_count = MissingPersonModel::all()->count();
        $pagination = '<ul class="pagination">';
        if ($page) {
            $pagination .= '<li><a href="../missingPersons" class="first"><<</a></li>';
            $i = $page - 2;
            while ($i < 1)
                $i++;
            if ($i > 1)
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            $j = $i + 5;
            for ($i; $i < $j && $i <= ceil($restaurants_count / 10); $i++) {
                if ($i == $page) {
                    $pagination .= '<li><a class="active" href="../missingPersons/' . $i . '">' . $i . '</a></li>';
                } else {
                    $pagination .= '<li><a href="../news/' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($i <= ceil($restaurants_count / 10)) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="../missingPersons/' . ceil($restaurants_count / 10) . '" class="last">>></a></li>';
            $pagination .= '</ul>';
            $restaurants = NewsModel::orderBy('updated_at', 'desc')->skip($page * 10 - 10)->take(10)->get();
            if(Session::get("organization"))
            {

                return view('missingPerson')->with("person", $restaurants)
                    ->with("pagination", $pagination)->with("organization",Session::get('organization'));
            }
            else if(Session::get("user"))
            {
                return view('missingPerson')->with("person", $restaurants)
                    ->with("pagination", $pagination)
                    ->with("user", Session::get("user"));
            }
            else
            {
                return view('missingPerson')->with("person", $restaurants)
                    ->with("pagination", $pagination);
            }
        } else {
            $i = 2;
            $pagination .= '<li><a href="missingPersons" class="first"><<</a></li><li><a href="missingPersons" class="active">1</a></li>';
            for ($i; $i < 6 && $i <= ceil($restaurants_count / 10); $i++) {
                $pagination .= '<li><a href="../news/' . $i . '">' . $i . '</a></li>';
            }
            if (ceil($restaurants_count / 10) > 5) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="missingPersons/' . ceil($restaurants_count / 10) . '" class="last">>></a></li>';
            $pagination .= '</ul>';
            $restaurants = MissingPersonModel::orderBy('updated_at', 'desc')->take(10)->get();
            if(Session::get("organization"))
            {

                                  return view('missingPerson')->with("person", $restaurants)
                        ->with("pagination", $pagination)->with("organization",Session::get('organization'));
            }
            else if(Session::get("user"))
            {
                return view('missingPerson')->with("person", $restaurants)
                    ->with("pagination", $pagination)
                    ->with("user", Session::get("user"));
            }
            else
            {
                return view('missingPerson')->with("person", $restaurants)
                    ->with("pagination", $pagination);
            }

        }
    }

    public function addMissingPerson(){
        $request = Request::all();
        $person = new MissingPersonModel();

        $person->name = $request['name'];
        $person->surname = $request['surname'];
        $person->sex = $request['sex'];
        $person->birthdate = $request['birthdate'];
        $person->country = $request['country'];
        $person->city = $request['city'];
        $person->address = $request['address'];
        Request::file('img_url')->move('images', $request["name"].'.jpg');
        $person->img_url = $request["name"].'.jpg';

        $person->save();
        return redirect('missingPersons');
    }
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
