<?php
namespace App\Services;
use Auth;
use App\User;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\Role_Menu;
use App\Models\Menu;
use redirect;
use Smenu;
use App\Models\Admin;
use DB;

class Backend
{

    #----------------------------------------#
    #       Quản lý và phân quyền admin      #
    #       không tùy tiện thay đổi          #
    #----------------------------------------#

    public function checkRole($permission)
    {
        $hasPermission = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->join('roles', 'roles.id', '=', 'role_users.role_id')
            ->join('role_menus', 'role_menus.role_id', '=', 'roles.id' )
            ->join('menus', 'menus.id', '=', 'role_menus.menu_id')
            ->select('menus.*')
            ->where('users.id', Auth::id())
            ->where('menus.status', STATUS_PUBLIC)
            ->where('menus.permission', $permission)
            ->first(); 

        if (!$hasPermission) {
            abort(401, "You don't have permissions to access this area");
        }
    }


    public function isAdmin()
    {
        if (Admin::where('user_id',Auth::id())->first()) {
            return true;
        }
        return false;
    }

    public function getMenuByUserAndParentId($parentId)
    {        
        $result = DB::table('users')
            ->join('role_users', 'users.id', '=', 'role_users.user_id')
            ->join('roles', 'roles.id', '=', 'role_users.role_id')
            ->join('role_menus', 'role_menus.role_id', '=', 'roles.id' )
            ->join('menus', 'menus.id', '=', 'role_menus.menu_id')
            ->select('menus.*')
            ->where('users.id', Auth::id())
            ->where('menus.status', STATUS_PUBLIC)
            ->where('menus.parent_id', $parentId)
            ->orderBy('menus.sort_order','ASC')
            ->get(); 

        return objectToArray($result);                  
    }


    public function getAllMenuHasRole()
    {
        $menuList = Backend::getMenuByUserAndParentId(0);
         if ($menuList) { 
             foreach ($menuList as $k => $value) {
                 $menuList[$k]['child'] = Backend::getMenuByUserAndParentId($value['id']);  
                 if ($menuList[$k]['child']) {
                     foreach ($menuList[$k]['child'] as $i => $v) {
                         $menuList[$k]['child'][$i]['minLevel'] = Backend::getMenuByUserAndParentId($v['id']);                            
                     }
                 }
             }
         }
        return $menuList;
        return null;
    }

#========================== end Role permission =====================================#

}
