<?php
namespace App\Services;
use Auth;
use App\User;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\Role_Menu;
use App\Models\Menu;
use DB;

class Srole
{
    public function checkRolePermission($role_id, $menu_id)
    {
       if (Role_Menu::where('role_id', $role_id)->where('menu_id',$menu_id)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteRolePermission($role_id, $menu_id)
    {
       $rolePer = Role_Menu::where('role_id', $role_id)->where('menu_id',$menu_id)->first();
       if ($rolePer) {
           $rolePer->delete();
       }
    }

    public function AddRolePermission($role_id, $menu_id)
    {
        $rolePer = $this->checkRolePermission($role_id, $menu_id);
        if (!$rolePer) {
            $rolePer = new Role_Menu;
            $rolePer->role_id = $role_id;
            $rolePer->menu_id = $menu_id;
            $rolePer->save();
        }
    }

    public function getRoleMenusByRoleId($role_id)
    {
        return Role_Menu::where('role_id', $role_id)->get()->toArray();
    }

    public function getAllRoleByModule($module, $get=null)
    {
        return Role::where('module', $module)->get($get)->toArray();
    }

    public function checkRoleUser($role_id, $user_id)
    {
       if (Role_User::where('role_id', $role_id)->where('user_id',$user_id)->first()) {
            return true;
        } else {
            return false;
        }
    }
}
