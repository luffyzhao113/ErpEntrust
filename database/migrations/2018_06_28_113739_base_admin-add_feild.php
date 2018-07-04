<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BaseAdminAddFeild extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('base_admins', function (Blueprint $table) {
            $table->string('name', 20)->default('无名氏');
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('base_admins', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('photo');
        });
    }
}
