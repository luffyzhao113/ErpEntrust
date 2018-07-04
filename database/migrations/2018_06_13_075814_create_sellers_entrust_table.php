<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersEntrustTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建商家角色表
        Schema::create('seller_roles', function (Blueprint $table) {
            // ID
            $table->increments('id');
            // 角色标识（用于程序）
            $table->string('name', 50)->unique();
            // 角色名称
            $table->string('display_name')->nullable();
            // 角色介绍
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // 创建商家角色和商家用户关联数据表
        Schema::create('seller_role_admin', function (Blueprint $table) {
            $table->integer('admin_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('admin_id')->references('id')->on('seller_admins')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('seller_roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['admin_id', 'role_id']);
        });

        // 创建权限数据表
        Schema::create('seller_permissions', function (Blueprint $table) {
            // ID
            $table->increments('id');
            // 上级权限
            $table->integer('parent_id')->unsigned()->default(0);
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
        Schema::create('seller_permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')->references('id')->on('seller_permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('seller_roles')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_roles');
        Schema::dropIfExists('seller_role_admin');
        Schema::dropIfExists('seller_permissions');
        Schema::dropIfExists('seller_permission_role');
    }
}
