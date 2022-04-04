<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserSocialAccountInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_social_account_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instagram_username')->nullable();
            $table->unsignedBigInteger('instagram_followers')->nullable();
            $table->string('tiktok_username')->nullable();
            $table->unsignedBigInteger('tiktok_followers')->nullable();
			$table->unsignedBigInteger('user_id');
            $table->commonFields();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_social_accounts');
    }
}
