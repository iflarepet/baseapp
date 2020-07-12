<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_id');
            $table->string('message', 255);
            $table->string('param', 255)->nullable(); 
            $table->string('url', 255);
            $table->timestamp('date')->nullable(); 
            $table->string('status', 10);
            $table->timestamp('deleted_at')->nullable();
            $table->string('created_by', 60);
            $table->string('updated_by', 60);  
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
        Schema::dropIfExists('notifications');
    }
}
