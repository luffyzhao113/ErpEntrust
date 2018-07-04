<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSellersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 商家资料表
        Schema::create('sellers', function (Blueprint $table) {
            $table->increments('id');
            // 商家名称
            $table->string('name', 50);
            // 商家状态 0 关闭; 1 开启;
            $table->tinyInteger('status');
            // 商家审核状态 0 未审核; 1 已审核
            $table->tinyInteger('verify');
            // 商家租金到期时间
            $table->date('rent_expire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}
