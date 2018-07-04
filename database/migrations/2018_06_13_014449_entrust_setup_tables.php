<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class EntrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // 创建角色表
        Schema::create('base_roles', function (Blueprint $table) {
            // ID
            $table->increments('id');
            // 角色标识（用于程序）
            $table->string('name', 50)->unique();
            // 是否开启
            $table->tinyInteger('status')->default(1);
            // 是否超级管理员
            $table->tinyInteger('super')->default(0);
            // 角色介绍
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // 创建权限数据表
        Schema::create('base_permissions', function (Blueprint $table) {
            // ID
            $table->increments('id');
            // 上级权限
            $table->integer('parent_id')->default(0)->unsigned();
            // 权限标识
            $table->string('name', 50)->unique();
            // 菜单图标
            $table->string('icon', 50)->nullable();
            // 是否菜单
            $table->tinyInteger('islink')->default(1);
            // 权限名称
            $table->string('display_name');
            // 权限说明
            $table->string('description')->nullable();
            // 权限创建修改时间
            $table->timestamps();
        });

        // 创建角色权限关联表
        Schema::create('base_permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('base_permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('base_roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::drop('base_permission_role');
        Schema::drop('base_permissions');
        Schema::drop('base_roles');
    }
}
