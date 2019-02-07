<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
class HomeController extends Controller
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
        $productOfer = Product::where('status',STATUS_PUBLIC)->take(5)->orderBy('id','DESC')->get();
        $productDeal = Product::where('status',STATUS_PUBLIC)
                                ->skip(6)->take(10)
                                ->orderBy('id','DESC')->get();
        return view('site.home.index',compact('productOfer','productDeal'));
    }

    public function test()
    {
        echo "string";die();
        
    }
}
