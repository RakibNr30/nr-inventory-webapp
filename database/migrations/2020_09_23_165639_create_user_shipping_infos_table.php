<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserShippingInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_shipping_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('phone')->nullable();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->text('address')->nullable();
			$table->text('extra_info')->nullable();
			$table->string('zip_code')->nullable();
			$table->string('city')->nullable();
			$table->string('country_code')->nullable();
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
        Schema::dropIfExists('user_shipping_infos');
    }
}
