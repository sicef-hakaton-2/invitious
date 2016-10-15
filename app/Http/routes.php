<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::post("users/get/locations/find/load", array("as"=>"users/get/locations/find/load","uses" => "IndexController@getAllLocations"));
Route::post('organization/account/update', array("as"=>"organization/account/update","uses"=>"OrganizationsController@update_organization"));
Route::post("/organization/accept/request", array('as'=>'/organization/accept/request','uses'=>'OrganizationsController@accept_request'));
Route::post("/organization/reject/request", array('as'=>'/organization/reject/request','uses'=>'OrganizationsController@reject_request'));
Route::post("/organization/remove/hosted", array('as'=>'/organization/remove/hosted','uses'=>'OrganizationsController@remove_hosted'));
Route::get("/organization/hosted/{page?}", array('as'=>'/organization/hosted/{page?}','uses'=>'OrganizationsController@hosted'));
Route::get("search/tmp", array('as'=>'search/tmp','uses'=>'SearchController@index'));
Route::get("user/search/{page?}", array("as"=>"user/search/{page?}","uses"=>"SearchController@search_user"));
Route::get("search/{page?}", array("as"=>"search/{page}","uses"=>"SearchController@search"));
Route::get("organization/search/{page?}", array("as"=>"organization/search/{page?}","uses"=>"SearchController@search_org"));
Route::get("organizations/search", array("as"=>"organizations/search","uses"=>"OrganizationsController@search_index"));
Route::get('organization/requests/{page?}',array("as"=>"organization/requests/{page?}","uses"=>"OrganizationsController@requests"));
Route::post("organization/news/save",array("as"=> "organization/news/save","uses"=> "OrganizationsController@newsSave"));
Route::get("organizations/news/{page?}",array("as"=> "organizations/news/{page?}","uses"=>"OrganizationsController@news"));
Route::post('register/user/check',array( 'as'=> 'register/user/check','uses' => 'RegisterController@register_user'));
Route::post('register/organization/check',array( 'as'=> 'register/organization/check','uses' => 'RegisterController@register_organizations'));
Route::post('login',array( 'as'=> 'login','uses' => 'LoginController@login'));
Route::get('register/user',array( 'as'=> 'register/user','uses' => 'IndexController@register_user'));
Route::get('register/organization',array( 'as'=> 'register/organization','uses' => 'IndexController@register_organization'));
Route::get('user/logout', array('as'=>'user/logout', 'uses' => 'UsersController@logout'));
Route::get('organization/logout', array('as'=>'organization/logout', 'uses' => 'OrganizationsController@logout'));
Route::get('user/account', array('as'=> 'user/account', 'uses' => 'UsersController@account'));
Route::post('user/arhive_loc', array('as'=> 'user/arhive_loc', 'uses' => 'UsersController@arhive_loc'));
Route::get('user',array( 'as'=> 'user','uses' => 'UsersController@index'));
Route::get('organization/',array( 'as'=> 'organization','uses' => 'OrganizationsController@news'));
Route::get('organization/account',array( 'as'=> 'organization/account','uses' => 'OrganizationsController@profile'));
Route::get('login/facebook',array( 'as'=> 'login/facebook','uses' => 'LoginController@facebook'));
Route::get('login/facebook/check',array( 'as'=> 'login/facebook/check','uses' => 'LoginController@facebook_check'));
Route::get('/',array( 'as'=> '/','uses' => 'IndexController@index'));
Route::get('organization/{id}', array('as'=> 'organization/{id}', 'uses' => 'IndexController@viewProfile'));
Route::get("donate",array( 'as'=>'donate','uses' => 'PayPalController@getDonate'));
Route::get('donate/success', array('as'=> 'donate/success', 'uses' => 'PayPalController@getDone'));
Route::get('donate/cancel', array('as'=> 'donate/cancel', 'uses' => 'PayPalController@getCancel'));
Route::post('get_locs', array('as'=> 'get_locs', 'uses' => 'UsersController@get_locs'));

Route::post('/user/edit', array("as"=>"/user/edit","uses"=>"UsersController@editt"));
Route::post('/user/friend', array("as"=>"/user/friend","uses"=>"UsersController@become_friends"));
Route::get('user/searchIndex', array("as"=>"user/searchIndex","uses"=>"UsersController@search_index"));
Route::post('send_req', array("as"=>"send_req","uses"=>"UsersController@send_req"));

Route::get('userP/{id}', array("as"=>"userP/{id}","uses"=>"IndexController@user_index"));
Route::get('missingPersons', array("as" => "missingPersons","uses"=>"IndexController@missingPersons"));
Route::post('addMissingPerson', array("as"=>'addMissingPerson',"uses"=>'IndexController@addMissingPerson'));
Route::post('/admin/check', array("as"=>'/admin/check',"uses"=>'IndexController@admin_check'));
Route::get('admin/logged', array("as"=>'admin/logged',"uses"=>'AdminController@index'));
Route::get('/admin', array("as"=>'/admin',"uses"=>'IndexController@admin'));
Route::post('admin/search', array("as"=>'admin/search',"uses"=>'AdminController@search'));
Route::post('admin/validate', array("as"=>'admin/validate',"uses"=>'AdminController@validateP'));