<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ip_address')->nullable();
            $table->text('request_url');
            $table->tinyInteger('device_type')->nullable()->comment('1. Mobile 2. Tablet 3. Desktop 4. Bot');
            $table->tinyInteger('browser_type')->nullable()->comment('1. Chrome 2. Firefox 3. Opera 4. Safari 5. IE 6. Edge');
            $table->string('browser_name')->nullable();
            $table->string('browser_family')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('browser_engine')->nullable();
            $table->tinyInteger('os_type')->nullable()->comment('1. Windows 2. Linux 3. Mac 4. Android');
            $table->string('os_name')->nullable();
            $table->string('os_family')->nullable();
            $table->string('os_version')->nullable();
            $table->string('device_family')->nullable();
            $table->string('device_model')->nullable();
            $table->string('device_grade')->nullable();
            $table->bigInteger('visit_count')->default(1);
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
        Schema::dropIfExists('visitor_logs');
    }
}
