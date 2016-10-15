<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\OrganizationModel;
use App\User;
use Illuminate\Support\Facades\Session;
use Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Session::get("user"))
            $route="user/search";
        else if(Session::get("organization"))
            $route="organization/search";
        else
            $route="search";
        return view("search_tmp")->with("country",OrganizationModel::queryDB("SELECT DISTINCT country FROM organizations WHERE 1"))
            ->with("city",OrganizationModel::queryDB("SELECT DISTINCT city FROM organizations WHERE 1"))
            ->with("route",$route);
    }
    public function search($page = NULL)
    {
        $request = Request::all();
        $search = $request["search"];
        $string = "?search=$search";

        $sql = "SELECT users.*,organizations.name as org_name,GROUP_CONCAT(DISTINCT CONCAT(locations.lat,' ',locations.lon)) as locations FROM users
        LEFT JOIN locations ON locations.user_id = users.id
        LEFT JOIN hosted on hosted.user_id = users.id
        LEFT JOIN organizations ON organizations.id = hosted.id
        WHERE users.name LIKE '$search%' OR users.surname LIKE '$search%' OR users.address LIKE '$search%' OR CONCAT(users.name,' ',users.surname) LIKE '$search%'
        OR CONCAT(users.surname,' ',users.name) OR users.country LIKE '$search%' OR users.city LIKE '$search%'";
        $sql.=" GROUP BY users.id";
        $count = count(User::queryDB($sql));
        $pagination = '<ul class="pagination">';
        if ($page) {
            $skip = $page*10 - 10;
            $pagination .= '<li><a href="../search'.$string.'" class="first"><<</a></li>';
            $i = $page - 2;
            while ($i < 1)
                $i++;
            if ($i > 1)
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            $j = $i + 5;
            for ($i; $i < $j && $i <= ceil($count / 10); $i++) {
                if ($i == $page) {
                    $pagination .= '<li><a class="active" href="../search/' . $i .$string.'"">' . $i . '</a></li>';
                } else {
                    $pagination .= '<li><a href="../search/' . $i .$string.'">' . $i . '</a></li>';
                }
            }
            if ($i <= ceil($count / 10)) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="../search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
            $pagination .= '</ul>';
            $sql.= " LIMIT $skip,10";

            return view("search_users")->with("users",User::queryDB($sql))
                ->with('pagination',$pagination);
        } else {
            $i = 2;
            $pagination .= '<li><a href="search" class="first"><<</a></li><li><a href="search'.$string.'" class="active">1</a></li>';
            for ($i; $i < 6 && $i <= ceil($count / 10); $i++) {
                $pagination .= '<li><a href="search/' . $i .$string.'">' . $i . '</a></li>';
            }
            if (ceil($count / 10) > 5) {
                $pagination .= '<li><a href="#" class="disabled">...</a></li>';
            }
            $pagination .= '<li><a href="search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
            $pagination .= '</ul>';

            $sql.= " LIMIT 10";

            return view("search_users")->with("users",User::queryDB($sql))
                ->with('pagination',$pagination);
        }



    }
    public function search_user($page = NULL)
    {
        $request = Request::all();
        $search = $request["search"];
        $search_for = $request["search_for"];
        $country = $request["country"];
        $city = $request["city"];
        $string = "?search=$search&search_for=$search_for&country=$country&city=$city";
        if($search_for=='organization')
        {
            $sql = "SELECT organizations.capacity-organizations.reserved as free, organizations.*,GROUP_CONCAT(DISTINCT hosted.user_id) as users FROM organizations
            LEFT JOIN hosted ON hosted.organization_id = organizations.id
            WHERE (organizations.name LIKE '$search%' OR organizations.address LIKE '$search%') ";
            if($country!="0")
                $sql.=" AND organizations.country = '$country'";
            if($city!="0")
                $sql.=" AND organizations.city = '$city'";
            $sql.=" GROUP BY organizations.id";
            $count = count(OrganizationModel::queryDB($sql));
            $pagination = '<ul class="pagination">';
            if ($page) {
                $skip = $page*10 - 10;
                $pagination .= '<li><a href="../search'.$string.'" class="first"><<</a></li>';
                $i = $page - 2;
                while ($i < 1)
                    $i++;
                if ($i > 1)
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                $j = $i + 5;
                for ($i; $i < $j && $i <= ceil($count / 10); $i++) {
                    if ($i == $page) {
                        $pagination .= '<li><a class="active" href="../search/' . $i .$string.'"">' . $i . '</a></li>';
                    } else {
                        $pagination .= '<li><a href="../search/' . $i .$string.'">' . $i . '</a></li>';
                    }
                }
                if ($i <= ceil($count / 10)) {
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                }
                $pagination .= '<li><a href="../search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
                $pagination .= '</ul>';
                $sql.= " LIMIT $skip,10";

                return view("user_search_organizations")->with("organizations",OrganizationModel::queryDB($sql))
                    ->with('pagination',$pagination);
            } else {
                $i = 2;
                $pagination .= '<li><a href="search" class="first"><<</a></li><li><a href="search'.$string.'" class="active">1</a></li>';
                for ($i; $i < 6 && $i <= ceil($count / 10); $i++) {
                    $pagination .= '<li><a href="search/' . $i .$string.'">' . $i . '</a></li>';
                }
                if (ceil($count / 10) > 5) {
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                }
                $pagination .= '<li><a href="search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
                $pagination .= '</ul>';

                $sql.= " LIMIT 10";

                return view("user_search_organizations")->with("organizations",OrganizationModel::queryDB($sql))
                    ->with('pagination',$pagination);
            }
        }
        else
        {
            $sql = "SELECT users.*,organizations.name as org_name,GROUP_CONCAT(DISTINCT CONCAT(locations.lat,' ',locations.lon)) as locations FROM users
            LEFT JOIN locations ON locations.user_id = users.id
            LEFT JOIN hosted on hosted.user_id = users.id
            LEFT JOIN organizations ON organizations.id = hosted.id
            WHERE (users.name LIKE '$search%' OR users.surname LIKE '$search%' OR users.address LIKE '$search%') ";
            if($country!="0")
                $sql.=" AND organizations.country = '$country'";
            if($city!="0")
                $sql.=" AND organizations.city = '$city'";
            $sql.=" GROUP BY users.id";
            $count = count(User::queryDB($sql));
            $pagination = '<ul class="pagination">';
            if ($page) {
                $skip = $page*10 - 10;
                $pagination .= '<li><a href="../search'.$string.'" class="first"><<</a></li>';
                $i = $page - 2;
                while ($i < 1)
                    $i++;
                if ($i > 1)
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                $j = $i + 5;
                for ($i; $i < $j && $i <= ceil($count / 10); $i++) {
                    if ($i == $page) {
                        $pagination .= '<li><a class="active" href="../search/' . $i .$string.'"">' . $i . '</a></li>';
                    } else {
                        $pagination .= '<li><a href="../search/' . $i .$string.'">' . $i . '</a></li>';
                    }
                }
                if ($i <= ceil($count / 10)) {
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                }
                $pagination .= '<li><a href="../search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
                $pagination .= '</ul>';
                $sql.= " LIMIT $skip,10";

                return view("user_search_users")->with("users",User::queryDB($sql))
                    ->with('pagination',$pagination);
            } else {
                $i = 2;
                $pagination .= '<li><a href="search" class="first"><<</a></li><li><a href="search'.$string.'" class="active">1</a></li>';
                for ($i; $i < 6 && $i <= ceil($count / 10); $i++) {
                    $pagination .= '<li><a href="search/' . $i .$string.'">' . $i . '</a></li>';
                }
                if (ceil($count / 10) > 5) {
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                }
                $pagination .= '<li><a href="search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
                $pagination .= '</ul>';

                $sql.= " LIMIT 10";

                return view("user_search_users")->with("users",User::queryDB($sql))
                    ->with('pagination',$pagination);
            }
        }



    }
    public function search_org($page = NULL)
    {
        $request = Request::all();
        $search = $request["search"];
        $search_for = $request["search_for"];
        $country = $request["country"];
        $city = $request["city"];
        $string = "?search=$search&search_for=$search_for&country=$country&city=$city";
        if($search_for=='organization')
        {
            $sql = "SELECT organizations.capacity-organizations.reserved as free,organizations.*,GROUP_CONCAT(DISTINCT hosted.user_id) as users
            FROM organizations
            LEFT JOIN hosted ON hosted.organization_id = organizations.id
            WHERE (organizations.name LIKE '$search%' OR organizations.address LIKE '$search%') ";
            if($country!="0")
                $sql.=" AND organizations.country = '$country'";
            if($city!="0")
                $sql.=" AND organizations.city = '$city'";
            $sql.=" GROUP BY organizations.id";
            $count = count(OrganizationModel::queryDB($sql));
            $pagination = '<ul class="pagination">';
            if ($page) {
                $skip = $page*10 - 10;
                $pagination .= '<li><a href="../search'.$string.'" class="first"><<</a></li>';
                $i = $page - 2;
                while ($i < 1)
                    $i++;
                if ($i > 1)
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                $j = $i + 5;
                for ($i; $i < $j && $i <= ceil($count / 10); $i++) {
                    if ($i == $page) {
                        $pagination .= '<li><a class="active" href="../search/' . $i .$string.'"">' . $i . '</a></li>';
                    } else {
                        $pagination .= '<li><a href="../search/' . $i .$string.'">' . $i . '</a></li>';
                    }
                }
                if ($i <= ceil($count / 10)) {
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                }
                $pagination .= '<li><a href="../search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
                $pagination .= '</ul>';
                $sql.= " LIMIT $skip,10";

                return view("organization_search_organizations")->with("organizations",OrganizationModel::queryDB($sql))
                    ->with('pagination',$pagination);
            } else {
                $i = 2;
                $pagination .= '<li><a href="search" class="first"><<</a></li><li><a href="search'.$string.'" class="active">1</a></li>';
                for ($i; $i < 6 && $i <= ceil($count / 10); $i++) {
                    $pagination .= '<li><a href="search/' . $i .$string.'">' . $i . '</a></li>';
                }
                if (ceil($count / 10) > 5) {
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                }
                $pagination .= '<li><a href="search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
                $pagination .= '</ul>';

                $sql.= " LIMIT 10";

                return view("organization_search_organizations")->with("organizations",OrganizationModel::queryDB($sql))
                    ->with('pagination',$pagination);
            }
        }
        else
        {
            $sql = "SELECT users.*,organizations.name as org_name,GROUP_CONCAT(DISTINCT CONCAT(locations.lat,' ',locations.lon)) as locations FROM users
            LEFT JOIN locations ON locations.user_id = users.id
            LEFT JOIN hosted on hosted.user_id = users.id
            LEFT JOIN organizations ON organizations.id = hosted.id
            WHERE (users.name LIKE '$search%' OR users.surname LIKE '$search%' OR users.address LIKE '$search%') ";
            if($country!="0")
                $sql.=" AND organizations.country = '$country'";
            if($city!="0")
                $sql.=" AND organizations.city = '$city'";
            $sql.=" GROUP BY users.id";
            $count = count(User::queryDB($sql));
            $pagination = '<ul class="pagination">';
            if ($page) {
                $skip = $page*10 - 10;
                $pagination .= '<li><a href="../search'.$string.'" class="first"><<</a></li>';
                $i = $page - 2;
                while ($i < 1)
                    $i++;
                if ($i > 1)
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                $j = $i + 5;
                for ($i; $i < $j && $i <= ceil($count / 10); $i++) {
                    if ($i == $page) {
                        $pagination .= '<li><a class="active" href="../search/' . $i .$string.'"">' . $i . '</a></li>';
                    } else {
                        $pagination .= '<li><a href="../search/' . $i .$string.'">' . $i . '</a></li>';
                    }
                }
                if ($i <= ceil($count / 10)) {
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                }
                $pagination .= '<li><a href="../search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
                $pagination .= '</ul>';
                $sql.= " LIMIT $skip,10";

                return view("organization_search_users")->with("users",User::queryDB($sql))
                    ->with('pagination',$pagination);
            } else {
                $i = 2;
                $pagination .= '<li><a href="search" class="first"><<</a></li><li><a href="search'.$string.'" class="active">1</a></li>';
                for ($i; $i < 6 && $i <= ceil($count / 10); $i++) {
                    $pagination .= '<li><a href="search/' . $i .$string.'">' . $i . '</a></li>';
                }
                if (ceil($count / 10) > 5) {
                    $pagination .= '<li><a href="#" class="disabled">...</a></li>';
                }
                $pagination .= '<li><a href="search/' . ceil($count / 10) .$string.'" class="last">>></a></li>';
                $pagination .= '</ul>';

                $sql.= " LIMIT 10";

                return view("organization_search_users")->with("users",User::queryDB($sql))
                    ->with('pagination',$pagination);
            }
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
