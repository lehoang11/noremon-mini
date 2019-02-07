<?php
namespace App\Services;
use Auth;
use App\User;
use App\Models\Role;
use App\Models\Role_User;
use App\Models\Role_Menu;
use App\Models\Menu;
use DB;

class Smenu
{
    public function getMenuAll()
    {
        return Menu::all();
    }

    public function getMenuById($id)
    {
         return Menu::findOrFail($id);
    }

    public function getMenuIdByModule($module,$get =null)
    {
        return Menu::where('module', $module)
                    ->where('status', STATUS_PUBLIC)->get($get)->toArray();
    }

    public function getMenuByModuleAndParent($module, $parent_id, $get = null)
    {
        return Menu::where('module', $module)
                    ->where('parent_id', $parent_id)
                    ->where('status', STATUS_PUBLIC)
                    ->orderBy('sort_order','ASC')
                    ->get($get)->toArray();
    }
    public function getAllMenuByModule($module, $parent_id)
    {
        return Menu::where('module', $module)
                    ->where('parent_id', $parent_id)
                    ->orderBy('sort_order','ASC')
                    ->get()->toArray();
    }

}
