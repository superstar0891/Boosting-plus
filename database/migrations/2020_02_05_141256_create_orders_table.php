<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
            $table->bigIncrements('id');
            $table->string('reference');
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('booster_id')->nullable();
            $table->foreign('booster_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('set null');
            $table->string('status')->nullable();
            $table->string('promo_code')->nullable();
            $table->string('game_system')->nullable();
            $table->string('login_email')->nullable();
            $table->string('login_username')->nullable();
            $table->string('login_password')->nullable();
            $table->string('payment_method')->nullable();
            $table->unsignedDecimal('total_payment_amount')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('boost_current_level')->nullable();
            $table->unsignedInteger('boost_desired_level')->nullable();
            $table->string('payee_email')->nullable();
            $table->string('payee_first_name')->nullable();
            $table->string('payee_last_name')->nullable();
            $table->string('payee_payer_id')->nullable();
            $table->string('payee_country_code')->nullable();
            $table->string('payee_business_name')->nullable();
            $table->string('payee_ip')->nullable();
            $table->string('payee_receipt_id')->nullable();
            $table->string('payee_transaction_id')->nullable();
            $table->tinyInteger('booster_paid')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
