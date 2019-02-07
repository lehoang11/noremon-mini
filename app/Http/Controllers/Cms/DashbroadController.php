<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Backend;
use redirect;
class DashbroadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Backend::checkRole('cms.dashboard');
        $breadcrumbs = array('root'=>'Home','routeLink' =>null);
        $actionLink = '<a href="'.action('Cms\DashbroadController@index').'"> dashbroad</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $title = 'Dashbroad';
        $hasMenu = Backend::getMenuByUserAndParentId(0);
        print_r($hasMenu);
        die();
        return view('cms.dashbroad.index',compact('title','breadcrumbs'));
    }
}
