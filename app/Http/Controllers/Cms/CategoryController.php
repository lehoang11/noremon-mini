<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Backend;
use redirect;
use App\Models\Category;
use DB;
use Session;
use Sproduct;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
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
        //Backend::checkRole('cms.category.view');
        $breadcrumbs = array('root'=>'Product','routeLink' =>'Category');
        $actionLink = '<a href="'.action('Cms\CategoryController@index').'"> Category</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $title = 'Category';
        $type = CATEGORY_PRODUCT_TYPE;
        if ($request->has('type')) {
            $type = $request->input('type');
        }
        $categoryList = Sproduct::getAllCategoryByParentAndPublic(0, $type);
        if ($categoryList) {
            foreach ($categoryList as $k => $value) {
                $categoryList[$k]['child'] =  Sproduct::getAllCategoryByParentAndPublic($value['id']);
                if ($categoryList[$k]['child']) {
                    foreach ($categoryList[$k]['child'] as $i => $v) {
                        $categoryList[$k]['child'][$i]['minLevel'] = Sproduct::getAllCategoryByParentAndPublic($v['id']);
                    }
                }
            }
        }

        return view('cms.category.index',compact('title','breadcrumbs','categoryList'));
    }

    public function create()
    {
        //Backend::checkRole('cms.category.view');
        $category = new Category;
        $breadcrumbs = array('root'=>'Product','routeLink' =>'Category');
        $actionLink = '<a href="'.action('Cms\CategoryController@index').'"> Category</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $title = 'Category';

        return view('cms.category.create',compact('title','breadcrumbs','category'));
    }

    public function store(CategoryRequest $request)
    {
        //Backend::checkRole('cms.category.view');
        $data = $request->all();
        $data['slug'] = convertToSlug($data['name']);
        $data['status'] = isset($request->status) ? 1:0;
        unset($data['use_path']);
        DB::beginTransaction();
        try {
            Category::create($data);
             DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Có lỗi trong quá trình thêm mới');
            return redirect()->action('Cms\CategoryController@create');
        }
        Session::flash('success', 'Thêm mới thành công');
        return redirect()->action('Cms\CategoryController@index');
    }

    public function edit($id)
    {
        //Backend::checkRole('cms.category.edit');
        $breadcrumbs = array('root'=>'Product','routeLink' =>'Category');
        $actionLink = '<a href="'.action('Cms\CategoryController@index').'"> Category</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $title = 'Category';
        $category = Category::findOrFail($id);
        $categoryList = Sproduct::getAllCategoryByParentAndPublic(0, $category->type);
        if ($categoryList) {
            foreach ($categoryList as $k => $value) {
                $categoryList[$k]['child'] = Sproduct::getAllCategoryByParentAndPublic($value['id'],$category->type);
            }
        }
        return view('cms.category.edit',compact('title','breadcrumbs','category','categoryList'));
    }

    public function update(CategoryRequest $request, $id)
    {
        //Backend::checkRole('cms.category.edit');
        $data = $request->all();
        $data['slug'] = convertToSlug($data['name']);
        $data['status'] = isset($request->status) ? 1:0;
        unset($data['use_path']);
        DB::beginTransaction();
        try {
            Category::find($id)->update($data);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Có lỗi trong quá trình thêm mới');
            return redirect()->action('Cms\CategoryController@edit',$id);
        }

        Session::flash('success', 'Sửa thành công');
        return redirect()->action('Cms\CategoryController@index');

    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            Category::find($id)->update(['status'=> 99]);
            DB::commit();
        } catch(\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Có lỗi trong quá trình xóa bản ghi');
            return redirect()->action('Cms\CategoryController@index');
        }

        Session::flash('success', 'Xóa thành công');
        return redirect()->action('Cms\CategoryController@index');

    }

    public function ajax_category(Request $request)
    {
        $type = $request->input('type');
        $categoryList = Sproduct::getAllCategoryByParentAndPublic(0, $type);
        if ($categoryList) {
            foreach ($categoryList as $k => $value) {
                $categoryList[$k]['child'] = Sproduct::getAllCategoryByParentAndPublic($value['id'], $type);
            }
        }

        $aHtml = view('cms.category.category_ajax')->with('categoryList', $categoryList)->render();
        return response()->json(array('success' => true, 'html'=>$aHtml));

    }

}
