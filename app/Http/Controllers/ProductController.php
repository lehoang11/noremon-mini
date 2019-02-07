<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use Session;
use Sproduct;

class ProductController extends Controller
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
        return view('site.product.category');
    }

    public function productCate(Request $request, $slug, $cate_id)
    {
        $q = null;
        $cateList = null;
        if ($request->has('q')) {
            $q = $request->input('q');
        }
        $category = Category::findOrFail($cate_id);
        if ($category->parent_id == 0) {
            $cateList = Sproduct::getCateProByParent($cate_id);
        }else{
            $cateList = Sproduct::getCateProByParent($category->parent_id);
        }
        $products = Sproduct::getProductByCateId($cate_id);

        return view('site.product.category',compact('category','cateList','products','q'));
    }

    public function productshow($slug, $id)
    {   
        $product = Product::findOrFail($id);
        $productPhoto = ProductPhoto::where('product_id',$id)->get();
        $category = Category::findOrFail($product->category_id);
        $productRe = Product::where('status',STATUS_PUBLIC)->take(5)->orderBy('id','DESC')->get();
        return view('site.product.detail',compact('product','category','productRe','productPhoto'));
    }

    public function addToCart()
    {
        echo "string";
    }

}
