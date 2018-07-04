<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->perimssions();
        $this->roles();
        $this->admins();
    }


    protected function admins(){
        $admins = [[
            'id' => 1,
            'email' => 'luffyzhao@vip.126.com',
            'password' => bcrypt('123456'),
            'role_id' => 1,
        ]];
        foreach ($admins AS $value){
            \App\Model\BaseAdmin::create($value);
        }
    }

    /**
     * 角色
     */
    protected function roles(){
        $roles = [[
            'id' => 1,
            'name' => '超级管理员',
            'status' => 1,
            'super' => 1,
            'description' => '超级管理员',
        ], [
            'id' => 2,
            'name' => '订单管理员',
            'status' => 1,
            'super' => 0,
            'description' => '订单管理员',
        ]];
        foreach ($roles AS $value){
            \App\Model\BaseRole::create($value);
        }
    }

    /**
     * 权限
     */
    protected function perimssions(){
        $permissions = [[
            'id' => 1,
            'parent_id' => 0,
            'name' => 'sysconfig.index',
            'icon' => 'ios-paper',
            'islink' => 1,
            'display_name' => '系统管理',
            'description' => '系统管理菜单',
        ],[
            'id' => 2,
            'parent_id' => 1,
            'name' => 'sysconfig.per',
            'icon' => 'ios-paper',
            'islink' => 1,
            'display_name' => '权限管理',
            'description' => '权限管理菜单',
        ],[
            'id' => 3,
            'parent_id' => 2,
            'name' => 'sysconfig.permission.index',
            'icon' => 'ios-paper',
            'islink' => 1,
            'display_name' => '权限&菜单',
            'description' => '权限&菜单',
        ],[
            'id' => 4,
            'parent_id' => 2,
            'name' => 'sysconfig.role.index',
            'icon' => 'compose',
            'islink' => 1,
            'display_name' => '角色管理',
            'description' => '角色管理菜单',
        ],[
            'id' => 5,
            'parent_id' => 2,
            'name' => 'sysconfig.admin.index',
            'icon' => 'compose',
            'islink' => 1,
            'display_name' => '用户管理',
            'description' => '用户管理菜单',
        ],];
        foreach ($permissions as $value){
            \App\Model\BasePermission::create($value);
        }
    }
}
