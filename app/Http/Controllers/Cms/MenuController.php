<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Backend;
use redirect;
use App\Models\Menu;
use Smenu;
use Session;
use App\Http\Requests\MenuRequest;
class MenuController extends Controller
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
    public function index($module)
    {
        Backend::checkRole('cms.menu');
        $title = 'menu';
        $breadcrumbs = array('root'=>'Config','routeLink' =>'Menu');
        $actionLink = '<a href="'.action('Cms\MenuController@index', $module).'"> Menu</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $menuList = Smenu::getMenuByModuleAndParent($module,0);
        if ($menuList) {
            foreach ($menuList as $k => $value) {
                $menuList[$k]['child'] =  Smenu::getMenuByModuleAndParent($module,$value['id']);
                if ($menuList[$k]['child']) {
                    foreach ($menuList[$k]['child'] as $i => $v) {
                        $menuList[$k]['child'][$i]['minLevel'] = Smenu::getMenuByModuleAndParent($module,$v['id']);
                    }
                }
            }
        }
        //var_dump($menuList);die();
        return view('cms.menu.index',compact('title','breadcrumbs','module','menuList'));
    }

    public function create($module)
    {
        Backend::checkRole('cms.menu.create');
        $menu = new Menu();
        $title = 'menu create';
        $breadcrumbs = array('root'=>'Config','routeLink' =>'menu');
        $actionLink = '<a href="'.action('Cms\MenuController@index', $module).'"> Menu</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $menuList = Smenu::getMenuByModuleAndParent($module,0);
        if ($menuList) {
            foreach ($menuList as $k => $value) {
                $menuList[$k]['child'] =  Smenu::getMenuByModuleAndParent($module,$value['id']);
            }
        }
        return view('cms.menu.create',compact('title','breadcrumbs','menu','module','menuList'));
    }

    public function store(MenuRequest $request, $module)
    {
        Backend::checkRole('cms.menu.create');
        $data = $request->all();
        $data['module'] = $module;
        $data['status'] = isset($request->status) ? 1:0;
        $menu = Menu::create($data);
        Session::flash('success', 'Thêm mới thành công');
        return redirect()->action('Cms\MenuController@index', $module);
    }

    public function edit($module, $id)
    {
        Backend::checkRole('cms.menu.edit');
        $menu = Menu::findOrFail($id);
        $title = 'menu edit';
        $breadcrumbs = array('root'=>'Config','routeLink' =>'menu');
        $actionLink = '<a href="'.action('Cms\MenuController@index', $module).'"> Menu</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $menuList = Smenu::getMenuByModuleAndParent($module,0);
        if ($menuList) {
            foreach ($menuList as $k => $value) {
                $menuList[$k]['child'] =  Smenu::getMenuByModuleAndParent($module,$value['id']);
            }
        }
        return view('cms.menu.edit',compact('title','breadcrumbs','menu','module','menuList'));
    }

    public function update(MenuRequest $request, $module, $id)
    {
        Backend::checkRole('cms.menu.edit');
        $data = $request->all();
        $data['status'] = isset($request->status) ? 1:0;
        $menu = Menu::findOrFail($id);
        $menu->update($data);
        Session::flash('success', 'Cập nhật thành công');
        return back();
    }

    public function destroy($module, $id)
    {
        # code...
    }

    public function ajax_menu(Request $request)
    {
        $module = $request->input('module');
        $menuList = Smenu::getMenuByModuleAndParent($module,0);
        if ($menuList) {
            foreach ($menuList as $k => $value) {
                $menuList[$k]['child'] =  Smenu::getMenuByModuleAndParent($module,$value['id']);
            }
        }

        $aHtml = view('cms.menu.menu_ajax')->with('menuList', $menuList)->render();
        return response()->json(array('success' => true, 'html'=>$aHtml));

    }
}
