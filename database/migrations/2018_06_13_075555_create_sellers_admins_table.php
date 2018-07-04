<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 创建商家用户表
        Schema::create('seller_admins', function (Blueprint $table) {
            // ID
            $table->increments('id');
            // 所属商家
            $table->integer('seller_id')->unsigned();
            // 管理员登录邮箱
            $table->string('email', 50)->unique();
            // 管理员登录密码
            $table->string('password', 60)->nullable();
            // 是否超管（不受权限影响）
            $table->tinyInteger('issuper')->unsigned();
            // 管理员token
            $table->rememberToken();
            // 数据表时间
            $table->timestamps();
            // 外键
            $table->foreign('seller_id')->references('id')->on('sellers')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seller_admins');
    }
}
