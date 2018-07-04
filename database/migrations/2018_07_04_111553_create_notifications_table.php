<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('type');

            $table->string("notifiable_type", 100);
            $table->unsignedBigInteger("notifiable_id");

            $table->text('data');
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index(["notifiable_type", "notifiable_id"], 'notifiable_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
