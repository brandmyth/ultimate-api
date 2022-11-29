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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('section_id');
            $table->integer('category_id');        
            $table->integer('brand_id');  
            $table->integer('product_collection_id')->nullable();        
            $table->integer('admin_id');    
            $table->string('admin_type');    
            $table->string('product_name');    
            $table->string('product_code')->nullable();       
            $table->string('product_image');    
            $table->text('short_description');    
            $table->text('description');    
            $table->float('product_price');    
            $table->float('product_discount'); 
            $table->string('product_qty');       
            $table->string('product_weight')->nullable();    
            $table->string('product_video')->nullable();  
            $table->string('product_color')->nullable();  
            $table->string('product_size')->nullable();  
            $table->string('product_tags')->nullable(); 
            $table->text('attributes')->nullable(); 
            $table->string('meta_title');    
            $table->string('meta_description');    
            $table->string('meta_keywords');    
            $table->enum('is_popular',['No','Yes']);   
            $table->enum('is_featured',['No','Yes']);      
            $table->enum('is_bestseller',['No','Yes']);  
            $table->enum('is_dealsday',['No','Yes']);       
            $table->tinyInteger('status');
            $table->integer('stock');
            $table->string('product_slug');
            $table->integer('tax_id');       
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
        Schema::dropIfExists('products');
    }
};
