<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('password')->default('$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');
            $table->boolean('is_process_completed')->default(false);
            $table->boolean('is_brand')->nullable()->default(false);
            $table->boolean('is_influencer')->nullable()->default(false);
            $table->boolean('is_pre_selected')->nullable()->default(false);
            $table->string('reporting_tool_link')->nullable();
            $table->json('categories')->nullable();
            $table->boolean('terms_conditions')->nullable();
            $table->boolean('subscribe')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('remember_token')->nullable();
            $table->tinyInteger('profile_grade')->nullable()->default(10);
            $table->timestamp('approved_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
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
        Schema::dropIfExists('users');
    }
}
