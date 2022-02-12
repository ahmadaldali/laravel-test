<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_uuid')->nullable();
            $table->uuid('payment_uuid')->nullable();
            $table->uuid('order_statuse_uuid')->nullable();
            $table->uuid('uuid')->default(DB::raw('(UUID())'))->unique();;
            $table->double('delivery_fee', 8, 2)->default(0.0);
            $table->double('amount', 12, 2)->unique;
            $table->json('products');
            $table->json('address');
            $table->timestamp('shipped_at')->nullable();
            $table->timestamps();

            $table->foreign('user_uuid')->references('uuid')->on('users')->onDelete('cascade');
            $table->foreign('payment_uuid')->references('uuid')->on('payments')->onDelete('cascade');
            $table->foreign('order_statuse_uuid')->references('uuid')->on('order__statuses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}