<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->string('name', 60);
            $table->string('description', 60)->nullable();
            $table->string('url', 100);
            $table->string('resource_id', 50)->nullable();
            $table->string('icon_id', 60)->nullable();
            $table->integer('order_number')->nullable();
            $table->string('tag', 50)->nullable();
            $table->string('is_active', 1);
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
        Schema::dropIfExists('menus');
    }
}
