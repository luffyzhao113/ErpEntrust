<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldForLogs02 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('base_logs', function ($table) {
            $table->renameColumn('route', 'uri');
            $table->string('display_name', 100);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('base_logs', function (Blueprint $table) {
            $table->dropColumn('display_name');
            $table->renameColumn('uri', 'route');
        });
    }
}
