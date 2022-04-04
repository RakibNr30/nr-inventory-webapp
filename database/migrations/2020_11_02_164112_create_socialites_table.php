<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socialites', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('google_key')->nullable();
			$table->string('google_secret')->nullable();
			$table->string('facebook_key')->nullable();
			$table->string('facebook_secret')->nullable();
			$table->string('twitter_key')->nullable();
			$table->string('twitter_secret')->nullable();
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
        Schema::dropIfExists('socialites');
    }
}
