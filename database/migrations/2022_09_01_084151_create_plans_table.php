<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('lender_id')->unsigned()->index();
            $table->string('plan_name', 32)->comment('プラン名');
            $table->text('plan_description', 32)->nullable()->comment('プラン説明');
            $table->string('delay')->comment('時期');
            $table->string('price_includes')->nullable()->comment('料金に含まれるもの');
            $table->string('to_prepare')->nullable()->comment('準備が必要なもの');
            $table->string('collection')->nullable()->comment('集合時間');
            $table->string('return')->nullable()->comment('帰港時間');
            $table->string('reservation')->nullable()->comment('予約方法');
            $table->text('other')->nullable()->comment('備考');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
