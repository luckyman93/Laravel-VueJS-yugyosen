<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLendersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lenders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('member_type_id')->unsigned()->comment('表示箇所');
            $table->string('zip_code', 8)->nullable()->comment('郵便番号')->default('');
            $table->bigInteger('prefecture_id')->unsigned()->comment('都道府県');
            $table->bigInteger('city_id')->unsigned()->comment('市町村');
            $table->string('address', 255)->nullable()->comment('所番地')->default('');
            $table->bigInteger('port_id')->unsigned()->comment('港');
            $table->longText('map_url')->nullable()->comment('googleMap')->default('');
            $table->text('access_example')->nullable()->comment('アクセス説明')->default('');
            $table->string('phone', 13)->nullable()->comment('電話番号')->default('');
            $table->text('hp_url')->nullable()->comment('ホームページ')->default('');
            $table->string('price', 255)->nullable()->comment('料金')->default('');
            $table->string('parking', 255)->nullable()->comment('駐車場')->default('');
            $table->string('permission_img', 255)->comment('許可証')->nullable();
            $table->integer('boat_number')->nullable()->default(1);
            $table->text('other')->nullable()->default('');
            $table->bigInteger('created_user_id')->unsigned()->nullable();
            $table->bigInteger('updated_user_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('member_type_id')
                ->references('id')
                ->on('member_types')
                ->onDelete('no action');

            $table->foreign('prefecture_id')
                ->references('id')
                ->on('prefectures')
                ->onDelete('no action');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('no action');

            $table->foreign('port_id')
                ->references('id')
                ->on('ports')
                ->onDelete('no action');

            $table->foreign('created_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('no action');

            $table->foreign('updated_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lenders', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['member_type_id']);
            $table->dropForeign(['prefecture_id']);
            $table->dropForeign(['city_id']);
            $table->dropForeign(['port_id']);
            $table->dropForeign(['created_user_id']);
            $table->dropForeign(['updated_user_id']);
        });

        Schema::dropIfExists('lenders');
    }
}
