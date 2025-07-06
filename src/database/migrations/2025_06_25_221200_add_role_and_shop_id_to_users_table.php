<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleAndShopIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedTinyInteger('role')->default(3)->after('password')->comment('1=管理者, 2=店舗管理者, 3=一般ユーザー');
                $table->unsignedBigInteger('shop_id')->nullable()->after('role')->comment('店舗管理者は所属店舗ID');
                $table->foreign('shop_id')->references('id')->on('shops')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['shop_id']);
            $table->dropColumn('shop_id');
            $table->dropColumn('role');
        });
    }
}
