<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedBigInteger('category_id');
            $table->string('image')->nullable(); // Add image column
            $table->timestamps();
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
