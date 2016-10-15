<?php

namespace App\Http\Controllers;

use App\OrganizationModel;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\NewsModel;
use App\RequestModel;
use App\HostedModel;
use Illuminate\Support\Facades\Validator;

use Request;
class OrganizationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {   $this->beforeFilter(function(){
            if(!Session::get("organization"))
            {
                if(Session::get("user"))
                {
                    return redirect("user");
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
        return view("organization")->with("organization",Session::get("organization"));
    }
    public function requests($page = NULL)
    {
        $organization = Session::get("organization")->id;
        $sql = "SELECT organizations.capacity-organizations.reserved as free, organizations.id as org_id, users.* FROM organizations
              LEFT JOIN requests ON organizations.id = requests.id_org
              LEFT JOIN users ON requests.id_user = users.id
              WHERE organizations.id = $organization";
        $count = count(OrganizationModel::queryDB($sql));
        $pagination = '<ul class="pagination">';
        if ($page) {
            $skip = $page*10 - 10;
            $pagination .= '<li><a href="../requests" class="first"><<</a></li>';
            $i = $page - 2;
            while ($i < 1)
                $i++;
            if ($i > 1)
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            $j = $i + 5;
            for ($i; $i < $j && $i <= ceil($count / 10); $i++) {
                if ($i == $page) {
                    $pagination .= '<li><a class="active" href="../requests/' . $i .'"">' . $i . '</a></li>';
                } else {
                    $pagination .= '<li><a href="../requests/' . $i .'">' . $i . '</a></li>';
                }
            }
            if ($i <= ceil($count / 10)) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="../requests/' . ceil($count / 10) .'" class="last">>></a></li>';
            $pagination .= '</ul>';
            $sql.= " LIMIT $skip,10";

            return view("requests")->with("users",OrganizationModel::queryDB($sql))
                ->with('pagination',$pagination);
        } else {
            $i = 2;
            $pagination .= '<li><a href="requests" class="first"><<</a></li><li><a href="requests' . '" class="active">1</a></li>';
            for ($i; $i < 6 && $i <= ceil($count / 10); $i++) {
                $pagination .= '<li><a href="requests/' . $i . '">' . $i . '</a></li>';
            }
            if (ceil($count / 10) > 5) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="requests/' . ceil($count / 10) . '" class="last">>></a></li>';
            $pagination .= '</ul>';

            $sql .= " LIMIT 10";

            return view("requests")->with("users", OrganizationModel::queryDB($sql))
                ->with('pagination', $pagination);
        }
    }
    public function accept_request()
    {
        $request = Request::all();
        $user_id = $request["user_id"];
        $org_id = $request["org_id"];
        $req =  RequestModel::where("id_user",$user_id)->where("id_org",$org_id);
        $req->delete();
        $req = RequestModel::where("id_user",$user_id);
        $req->delete();
        $hosted = new HostedModel();
        $hosted->user_id = $user_id;
        $hosted->organization_id = $org_id;
        $hosted->save();
        $org = OrganizationModel::where("id",$org_id)->first();
        $org->reserved = $org->reserved+1;
        $org->update();
        return redirect("/organization/hosted");
    }
    public function reject_request()
    {
        $request = Request::all();
        $user_id = $request["user_id"];
        $org_id = $request["org_id"];
        $req =  RequestModel::where("id_user",$user_id)->where("id_org",$org_id);
        $req->delete();
        return redirect("/organization/requests");
    }
    public function hosted($page = NULL)
    {
        $organization = Session::get("organization")->id;
        $sql = "SELECT organizations.id as org_id, users.* FROM organizations
              LEFT JOIN hosted ON organizations.id = hosted.organization_id
              LEFT JOIN users ON hosted.user_id = users.id
              WHERE organizations.id = $organization";
        $count = count(OrganizationModel::queryDB($sql));
        $pagination = '<ul class="pagination">';
        if ($page) {
            $skip = $page*10 - 10;
            $pagination .= '<li><a href="../hosted" class="first"><<</a></li>';
            $i = $page - 2;
            while ($i < 1)
                $i++;
            if ($i > 1)
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            $j = $i + 5;
            for ($i; $i < $j && $i <= ceil($count / 10); $i++) {
                if ($i == $page) {
                    $pagination .= '<li><a class="active" href="../hosted/' . $i .'"">' . $i . '</a></li>';
                } else {
                    $pagination .= '<li><a href="../hosted/' . $i .'">' . $i . '</a></li>';
                }
            }
            if ($i <= ceil($count / 10)) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="../hosted/' . ceil($count / 10) .'" class="last">>></a></li>';
            $pagination .= '</ul>';
            $sql.= " LIMIT $skip,10";

            return view("hosted")->with("users",OrganizationModel::queryDB($sql))
                ->with('pagination',$pagination);
        } else {
            $i = 2;
            $pagination .= '<li><a href="hosted" class="first"><<</a></li><li><a href="hosted' . '" class="active">1</a></li>';
            for ($i; $i < 6 && $i <= ceil($count / 10); $i++) {
                $pagination .= '<li><a href="hosted/' . $i . '">' . $i . '</a></li>';
            }
            if (ceil($count / 10) > 5) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="hosted/' . ceil($count / 10) . '" class="last">>></a></li>';
            $pagination .= '</ul>';

            $sql .= " LIMIT 10";

            return view("hosted")->with("users", OrganizationModel::queryDB($sql))
                ->with('pagination', $pagination);
        }
    }
    public  function search_index()
    {
        return view ("organizationSearch")->with("organization",Session::get("organization"))
            ->with("country",OrganizationModel::queryDB("SELECT DISTINCT country FROM organizations WHERE 1"))
            ->with("city",OrganizationModel::queryDB("SELECT DISTINCT city FROM organizations WHERE 1"))
            ->with("route","organization/search");
    }
    public function remove_hosted()
    {
        $request = Request::all();
        $user_id = $request["user_id"];
        $org_id = $request["org_id"];
        $req =  HostedModel::where("user_id",$user_id)->where("organization_id",$org_id);
        $req->delete();
        $org = OrganizationModel::where("id",$org_id)->first();
        $org->reserved = $org->reserved-1;
        $org->update();
        return redirect("/organization/hosted");
    }
   /* public function news(){
        $news = NewsModel::where('id','>',0)->orderBy('id','desc')->get();
        return view("organizationNews")->with("organization",Session::get('organization'))->with("news",$news);
    }*/
    public function news($page = NULL)
    {
        $restaurants_count = NewsModel::all()->count();
        $pagination = '<ul class="pagination">';
        if ($page) {
            $pagination .= '<li><a href="../news" class="first"><<</a></li>';
            $i = $page - 2;
            while ($i < 1)
                $i++;
            if ($i > 1)
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            $j = $i + 5;
            for ($i; $i < $j && $i <= ceil($restaurants_count / 10); $i++) {
                if ($i == $page) {
                    $pagination .= '<li><a class="active" href="../news/' . $i . '">' . $i . '</a></li>';
                } else {
                    $pagination .= '<li><a href="../news/' . $i . '">' . $i . '</a></li>';
                }
            }
            if ($i <= ceil($restaurants_count / 10)) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="../news/' . ceil($restaurants_count / 10) . '" class="last">>></a></li>';
            $pagination .= '</ul>';
            $restaurants = NewsModel::orderBy('updated_at', 'desc')->skip($page * 10 - 10)->take(10)->get();
            return view('organizationNews')->with("news", $restaurants)
                ->with("pagination", $pagination)->with("organization",Session::get('organization'));
        } else {
            $i = 2;
            $pagination .= '<li><a href="news" class="first"><<</a></li><li><a href="news" class="active">1</a></li>';
            for ($i; $i < 6 && $i <= ceil($restaurants_count / 10); $i++) {
                $pagination .= '<li><a href="../news/' . $i . '">' . $i . '</a></li>';
            }
            if (ceil($restaurants_count / 10) > 5) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="news/' . ceil($restaurants_count / 10) . '" class="last">>></a></li>';
            $pagination .= '</ul>';
            $restaurants = NewsModel::orderBy('updated_at', 'desc')->take(10)->get();
            return view('organizationNews')->with("news", $restaurants)
                ->with("pagination", $pagination)->with("organization",Session::get('organization'));
        }
    }

    public function profile(){
        return view("organizationProfile")->with("organization",Session::get("organization"));
    }
    public function newsSave(){
        $request = Request::all();
        $news = new NewsModel();
        $news->subject = $request["subject"];
        $news->text = $request['text'];

        Request::file('img_url')->move('images', $request["subject"].'.jpg');
        $news->img_url = $request["subject"].'.jpg';
        $news->save();

        return redirect('organizations/news');
    }
    public function update_organization(){
        $request = Request::all();
        $errors = Validator::make($request, [
            'username' => 'required|min:4|max:255',
            'name' => 'required|min:4|max:255',
            'type' => 'required|min:4|max:255',
            'country' => 'required|min:2|max:255',
            'city' => 'required|min:2|max:255',
            'address' => 'required|min:2|max:255',
            'lat' => 'required|min:1|max:255',
            'lon' => 'required|min:1|max:255',
            'email' => 'required|email',
            'description' => 'required|min:2|max:1000',
            'capacity' => 'required',
        ]);
        if ($errors->fails()) {
            return redirect("organization/account")->withErrors($errors->messages())->withInput();
        }
        else
        {
            $organization = OrganizationModel::where("id","<>",$request["id"])->where('username',$request['username'])->first();
            if(!$organization){

                $organization = User::where("id","<>",$request["id"])->where('username',$request['username']);
                if(!$organization) {
                    $organization = OrganizationModel::where('username', $request['username'])->first();
                    $organization->username = $request["username"];
                    if($request!=""){
                        $organization->password = hash('sha256', $request["password"]);
                    }
                    $organization->name = $request["name"];
                    $organization->type = $request["type"];
                    $organization->country = $request["country"];
                    $organization->city = $request["city"];
                    $organization->address = $request["address"];
                    $organization->lat = $request["lat"];
                    $organization->lon = $request["lon"];
                    $organization->description = $request["description"];
                    $organization->capacity = $request["capacity"];
                    $organization->email = $request['email'];
                    $organization->reserved = 20;
                    $organization->update();
                    Session::put('organization', $organization);
                    return redirect('organization/account');
                }
                else{
                    $error['username'] = "Username already exist!";
                    return redirect("organization/account")->withErrors($error);
                }
            }
            else{
                $error['username'] = "Username already exist!";
                return redirect("organization/account")->withErrors($error);
            }

        }
    }
    public function logout()
    {
        Session::forget("organization");
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
