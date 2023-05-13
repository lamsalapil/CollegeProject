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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name_coupon');
            $table->string('coupon_code')->nullable();
            $table->integer('coupon_limited_quantity')->unsigned()->nullable()->default(10);
            $table->string('price_coupon')->nullable();
            $table->dateTime('valid_from');
            $table->dateTime('valid_until');
            $table->tinyInteger('status')->default(0)->comment('0=Not Show/ 1=Show');
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
        Schema::dropIfExists('coupons');
    }
};
