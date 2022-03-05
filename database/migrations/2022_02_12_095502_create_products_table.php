<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('uuid')->primary();
            $table->uuid('category_uuid')->nullable();
            $table->string('title', 255);
            $table->double('price', 12, 2);
            $table->text('description');
            $table->json('metadata');
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();

            $table->foreign('category_uuid')->references('uuid')->on('categories')->onDelete('cascade');
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
}
