<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_management', function (Blueprint $table) {
            $table->id();
            $table->string('address')->nullable();
            $table->string('office_contact')->nullable();  
            $table->string('email')->nullable();
            $table->string('working_hour')->nullable();
            $table->string('copyright_description')->nullable();  
            $table->string('hotline_no')->nullable();
            $table->string('hotline_description')->nullable();  
            $table->string('hotline_logo')->nullable();


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
        Schema::dropIfExists('footer_management');
    }
};
