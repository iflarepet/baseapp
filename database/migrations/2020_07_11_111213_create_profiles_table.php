<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->integer('user_id');
            $table->primary('user_id');
            $table->string('avatar', 100)->nullable();
            $table->date('dob')->nullable();
            $table->string('gender', 1)->nullable();
            $table->string('origin_id', 100)->nullable();
            $table->string('phone', 60)->nullable();
            $table->string('address1', 100)->nullable();
            $table->string('address2', 100)->nullable();
            $table->string('address3', 100)->nullable();
            $table->string('postal_code', 100)->nullable(); 
            $table->string('city_id', 100)->nullable();            
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
        Schema::dropIfExists('profiles');
    }
}
