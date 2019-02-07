<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Backend;
use redirect;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPhoto;
use DB;
use Session;
use Sproduct;
use App\Http\Requests\ProductRequest;
use File;


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
    public function index(Request $request)
    {
        //Backend::checkRole('cms.product.view');
        $breadcrumbs = array('root'=>'Product','routeLink' =>'Product');
        $actionLink = '<a href="'.action('Cms\ProductController@index').'"> Product</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $title = 'Product';
        $categoryList = Sproduct::getAllCategoryAndPublic($type = CATEGORY_PRODUCT_TYPE, array('id','name'));
        //var_dump($categoryList);die();
        $productList = Sproduct::getAllProduct();

        return view('cms.product.index',compact('title','breadcrumbs','categoryList','productList'));
    }

    public function create()
    {
        //Backend::checkRole('cms.category.view');
        $product = new Product;
        $breadcrumbs = array('root'=>'Product','routeLink' =>'Product');
        $actionLink = '<a href="'.action('Cms\ProductController@index').'"> Product</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $title = 'Product';
        $categoryList = Sproduct::getAllCategoryByParentAndPublic(0, CATEGORY_PRODUCT_TYPE);
        if ($categoryList) {
            foreach ($categoryList as $k => $value) {
                $categoryList[$k]['child'] = Sproduct::getAllCategoryByParentAndPublic($value['id'],CATEGORY_PRODUCT_TYPE);
            }
        }
        return view('cms.product.create',compact('title','breadcrumbs','product','categoryList'));
    }

    public function store(ProductRequest $request)
    {
        //Backend::checkRole('cms.category.view');
        $data = $request->all();
        $data['slug'] = convertToSlug($data['name']);
        $data['status'] = isset($request->status) ? 1:0;
        if ($data['photos']) {
            $photos = $data['photos'];
            unset($data['photos']);
        }
        unset($data['use_path']);
  
        DB::beginTransaction();
        try {
            $product = Product::create($data);
            if ($photos) {
                foreach ($photos as $photo) {
                    ProductPhoto::create(['product_id'=>$product->id, 'photo'=>$photo]);
                }
            }
             DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Có lỗi trong quá trình thêm mới');
            return redirect()->action('Cms\ProductController@create');
        }
        Session::flash('success', 'Thêm mới thành công');
        return redirect()->action('Cms\ProductController@index');
    }

    public function edit($id)
    {
        //Backend::checkRole('cms.product.edit');
        $breadcrumbs = array('root'=>'Product','routeLink' =>'Product');
        $actionLink = '<a href="'.action('Cms\ProductController@index').'"> Product</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $title = 'Product';
        $product = Product::findOrFail($id);
        $productPhotos = ProductPhoto::where('product_id', $id)->get();
        $categoryList = Sproduct::getAllCategoryByParentAndPublic(0, CATEGORY_PRODUCT_TYPE);
        if ($categoryList) {
            foreach ($categoryList as $k => $value) {
                $categoryList[$k]['child'] = Sproduct::getAllCategoryByParentAndPublic($value['id'],CATEGORY_PRODUCT_TYPE);
            }
        }
        return view('cms.product.edit',compact('title','breadcrumbs','product','categoryList','productPhotos'));
    }

    public function update(ProductRequest $request, $id)
    {
        //Backend::checkRole('cms.category.edit');
        $data = $request->all();
        $data['slug'] = convertToSlug($data['name']);
        $data['status'] = isset($request->status) ? 1:0;
        if ($data['photos']) {
            $photos = $data['photos'];
            unset($data['photos']);
        }
        unset($data['use_path']);
        DB::beginTransaction();
        try {
            Product::find($id)->update($data);
            if ($photos) {
                foreach ($photos as $photo) {
                    ProductPhoto::create(['product_id'=>$id, 'photo'=>$photo]);
                }
            }
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Có lỗi trong quá trình thêm mới');
            return redirect()->action('Cms\ProductController@edit',$id);
        }

        Session::flash('success', 'Sửa thành công');
        return redirect()->action('Cms\ProductController@index');

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Product::find($id)->update(['status'=> 99]);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Có lỗi trong quá trình xóa bản ghi');
            return redirect()->action('Cms\ProductController@index');
        }

        Session::flash('success', 'Xóa thành công');
        return redirect()->action('Cms\ProductController@index');

    }

    public function photo_product_delete(Request $request)
    {
        $id = $request->photo_id;
        $productPhoto = ProductPhoto::findOrFail($id);
        if (file_exists($productPhoto->photo)) {
            $file = $productPhoto->photo;
            File::delete($file);
        }
        $productPhoto->delete();
        return response()->json(array('success' => true, 'photo_id'=>$id));
    }


}
