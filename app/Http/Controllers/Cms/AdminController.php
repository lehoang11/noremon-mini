<?php

namespace App\Http\Controllers\Cms;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Backend;
use redirect;
use Session;
use DB;
use App\models\User;
use App\models\User_Profile;
use App\models\Role_User;
use Srole;
use App\Http\Requests\AdminRequest;
use App\Models\Admin;

class AdminController extends Controller
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
        Backend::checkRole('cms.admin');
        $title = 'menu';
        $breadcrumbs = array('root'=>'Config','routeLink' =>'Admin');
        $actionLink = '<a href="'.action('Cms\AdminController@index', $module).'"> Admin</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));
        $adminList = DB::table('users')
                    ->join('role_users', 'users.id', '=', 'role_users.user_id')
                    ->join('roles', 'roles.id', '=', 'role_users.role_id')
                    ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
                    ->where('roles.module', $module)
                    ->select('roles.id as role_id','roles.name','roles.description','users.email','user_profiles.*')
                    ->get();
        return view('cms.admin.index',compact('title','breadcrumbs','module','adminList'));
    }

    public function create($module)
    {
        //Backend::checkRole('cms.admin.create');
        $title = 'Admin create';
        $breadcrumbs = array('root'=>'Config','routeLink' =>'Admin');
        $actionLink = '<a href="'.action('Cms\AdminController@index', $module).'"> Admin</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));

        $roleList = Srole::getAllRoleByModule($module);
        $roleUser = new Role_User;
        $roleUserList = Role_User::all()->toArray();
        $userIdIn = array_column($roleUserList, 'user_id');
        $userList = DB::table('users')
                    ->join('user_profiles', 'user_profiles.user_id', '=', 'users.id')
                    ->where('user_profiles.is_active', 1)
                    ->where('user_profiles.status', STATUS_PUBLIC)
                    ->whereNotIn('users.id', $userIdIn)
                    ->select('users.*','user_profiles.first_name','user_profiles.last_name')
                    ->get();
        return view('cms.admin.create',compact('roleList','roleUser','userList','module','breadcrumbs'));

    }

    public function store(AdminRequest $request, $module)
    {
        //Backend::checkRole('cms.admin.create');
        $data = $request->all();
        $roleUser = Role_User::where('role_id', $data['role_id'])->where('user_id', $data['user_id'])->first();
        if ($roleUser) {
            Session::flash('error', 'Vai trò đã tồn tại');
            return redirect()->action('Cms\AdminController@index', $module);
        }
        Role_User::create($data);
        Admin::create(['module'=>$module,'user_id'=>$data['user_id']]);
        Session::flash('success', 'Thêm mới thành công');
        return redirect()->action('Cms\AdminController@index', $module);
    }

    public function edit($module, $user_id, $role_id)
    {
        //Backend::checkRole('cms.admin.create');
        $title = 'Admin edit';
        $breadcrumbs = array('root'=>'Config','routeLink' =>'Admin');
        $actionLink = '<a href="'.action('Cms\AdminController@index', $module).'"> Admin</a>';
        $breadcrumbs = array_merge($breadcrumbs, array('actionLink'=>$actionLink));

        $roleList = Srole::getAllRoleByModule($module);
        $roleUser = Role_User::where('role_id', $role_id)->where('user_id', $user_id)->first();
        $userProfile = User_Profile::where('user_id', $user_id)->first();
        return view('cms.admin.edit',compact('roleList','roleUser','userProfile','module','role_id','breadcrumbs'));

    }

    public function update(Request $request, $module, $user_id, $role_id )
    {
        $data = $request->all();
        $roleUser = Role_User::where('role_id', $role_id)->where('user_id', $user_id)->first();
        $roleUser->role_id = $data['role_id'];
        $roleUser->save();
        $admin = Admin::where('module',$module)->where('user_id',$user_id)->first();
        if (!$admin) {
            Admin::create(['module'=>$module,'user_id'=>$user_id]);
        }
        Session::flash('success', 'Cập nhật thành công');
        return redirect()->action('Cms\AdminController@index', $module);

    }

    public function destroy($user_id, $role_id)
    {
        $roleUser = Role_User::where('role_id', $role_id)->where('user_id', $user_id)->first();
        if ($roleUser) {
            $roleUser->delete();
        }
        $admin = Admin::where('module',1)->where('user_id',$user_id)->first();
        if ($admin) {
            $admin->delete();
        }
        Session::flash('success', 'xóa thành công');
        return back();
    }


}
