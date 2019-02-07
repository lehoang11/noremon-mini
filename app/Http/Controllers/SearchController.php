<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Sproduct;
use DB;
use App\Models\Category;
use App\Models\Product;
class SearchController extends Controller
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
    public function index(Request $request)
    {
        if (!$request->has('q')) {
            Session::flash('error', 'Vui lòng nhập từ khóa');
            return back();
        }
        $q = $request->input('q');
        $cateList = Sproduct::getCateByKyword($q);
        $products = Sproduct::getProductByKeyword($q);

        return view('site.search.index', compact('cateList','products','q'));
    }

}
