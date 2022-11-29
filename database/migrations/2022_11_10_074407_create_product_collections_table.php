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
        Schema::create('product_collections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('start_date')->nullable();  
            $table->string('end_date')->nullable();
            $table->string('discount_amount')->nullable();
            $table->enum('discount_type',['amount','percentage','same-price'])->nullable();
            $table->tinyInteger('status')->nullable();
            $table->text('description')->nullable();    
            $table->string('url')->nullable();    
            $table->string('meta_title')->nullable();    
            $table->string('meta_description')->nullable();    
            $table->string('meta_keywords')->nullable();  
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
        Schema::dropIfExists('product_collections');
    }
};
