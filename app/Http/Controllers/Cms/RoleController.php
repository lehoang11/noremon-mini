<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Backend;
use redirect;
use App\Models\Role;
use App\Models\Role_Menu;
use Smenu;
use Srole;
use App\Http\Requests\RoleRequest;
use Session;
class RoleController extends Controller
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
        Backend::checkRole('cms.role');
        $title = 'role';
        $breadcrumbs = array('root'=>'Config','routeLink' =>'Role');
        $actionLink = '<a href="'.action('Cms\RoleController@index', $module).'"> Role</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $roleList = Srole::getAllRoleByModule($module);
        return view('cms.role.index',compact('title','breadcrumbs','module', 'roleList'));
    }

    public function create($module)
    {
        //Backend::checkRole('cms.role.create');
        $role = new Role();
        $title = 'role';
        $breadcrumbs = array('root'=>'Config','routeLink' =>'Role');
        $actionLink = '<a href="'.action('Cms\RoleController@index', $module).'"> Role</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $menuList = Smenu::getMenuByModuleAndParent($module,0,$get = array('id','name','parent_id'));
        if ($menuList) {
            foreach ($menuList as $k => $value) {
                $menuList[$k]['child'] =  Smenu::getMenuByModuleAndParent($module,$value['id'], $get = array('id','name','parent_id'));
                if ($menuList[$k]['child']) {
                    foreach ($menuList[$k]['child'] as $i => $v) {
                        $menuList[$k]['child'][$i]['minLevel'] = Smenu::getMenuByModuleAndParent($module,$v['id'], $get = array('id','name','parent_id'));
                    }
                }
            }
        }
        $menuIdArray = array();
        return view('cms.role.create',compact('title','breadcrumbs','module','role','menuList','menuIdArray'));
    }

    public function store(RoleRequest $request, $module)
    {
        //Backend::checkRole('cms.role.create');
        $data = $request->all();
        $data['module'] = $module;
        $data['status'] = isset($request->status) ? 1:0;
        $menu_ids = $data['menu_ids'];
        unset($data['menu_ids']);
        $role = Role::create($data);
        if ($role && $menu_ids ) {
            foreach ($menu_ids as $menu_id) {
                Role_Menu::create(array('role_id' =>$role->id,'menu_id'=>$menu_id));
            }
        }
        Session::flash('success', 'Thêm mới thành công');
        return redirect()->action('Cms\RoleController@index', $module);
    }

    public function edit($module, $id)
    {
        //Backend::checkRole('cms.role.create');
        $title = 'role';
        $breadcrumbs = array('root'=>'Config','routeLink' =>'Role');
        $actionLink = '<a href="'.action('Cms\RoleController@index', $module).'"> Role</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $role = Role::findOrFail($id);
        $menuList = Smenu::getMenuByModuleAndParent($module,0,$get = array('id','name','parent_id'));
        if ($menuList) {
            foreach ($menuList as $k => $value) {
                $menuList[$k]['child'] =  Smenu::getMenuByModuleAndParent($module,$value['id'], $get = array('id','name','parent_id'));
                if ($menuList[$k]['child']) {
                    foreach ($menuList[$k]['child'] as $i => $v) {
                        $menuList[$k]['child'][$i]['minLevel'] = Smenu::getMenuByModuleAndParent($module,$v['id'], $get = array('id','name','parent_id'));
                    }
                }
            }
        }

        $roleMenu = Srole::getRoleMenusByRoleId($id);
        $menuIdArray = array_column($roleMenu, 'menu_id');
        return view('cms.role.edit',compact('title','breadcrumbs','module','role','menuList','menuIdArray'));
    }

    public function update(RoleRequest $request, $module, $id)
    {
        //Backend::checkRole('cms.role.create');
        $data = $request->all();
        $data['module'] = $module;
        $data['status'] = isset($request->status) ? 1:0;
        $menu_ids = $data['menu_ids'];
        unset($data['menu_ids']);
        $role = Role::findOrFail($id);
        $role->update($data);
        $menuList = Smenu::getMenuIdByModule($module, array('id'));
        foreach ($menuList as $menu) {
            if ($menu_ids && in_array($menu['id'], $menu_ids)) {
                if (Srole::checkRolePermission($id, $menu['id'])) {
                    # code...
                }else {
                    Srole::AddRolePermission($id, $menu['id']);
                }

            }else{
                if (Srole::checkRolePermission($id, $menu['id'])) {
                        Srole::deleteRolePermission($id, $menu['id']);
                }else{

                    }
            }
        }
        Session::flash('success', 'Thêm mới thành công');
        return redirect()->action('Cms\RoleController@index', $module);
    }

    public function destroy($module, $id)
    {
        # code...
    }
}
