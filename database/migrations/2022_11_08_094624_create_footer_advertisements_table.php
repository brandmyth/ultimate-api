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
        Schema::create('footer_advertisements', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();  
            $table->string('advertisement_image');  
            $table->string('url')->nullable();   
            $table->tinyInteger('status');
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
        Schema::dropIfExists('footer_advertisements');
    }
};
