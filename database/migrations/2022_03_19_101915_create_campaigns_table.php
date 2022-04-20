<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug');
            // new
            $table->unsignedBigInteger('brand_id')->nullable();

            $table->timestamp('start_date')->nullable();
            $table->timestamp('first_content_online')->nullable();
            $table->integer('cycle_count')->nullable();
            $table->integer('cycle_time_unit')->nullable()->default(1)->comment('Cooperation Duration - 1. Monthly, 2. Weekly');
            $table->json('product_ids')->nullable();
            $table->json('target_influencer_category_ids')->nullable();
            $table->json('target_influencer_genders')->nullable();
            // new
            $table->integer('target_influencer_lower_age')->nullable();
            $table->integer('target_influencer_upper_age')->nullable();

            $table->longText('target_influencer_details')->nullable();
            $table->unsignedBigInteger('amount_of_influencer_per_cycle')->nullable();
            $table->unsignedBigInteger('amount_of_influencer_follower_per_cycle')->nullable();
            $table->longText('extra_agreements')->nullable();
            // new
            $table->boolean('individual_coupon_code_internal')->nullable()->default(false);
            $table->boolean('individual_coupon_code_brand')->nullable()->default(false);
            $table->boolean('individual_swipe_up_link_internal')->nullable()->default(false);
            $table->boolean('individual_swipe_up_link_brand')->nullable()->default(false);
            $table->boolean('influencer_shipping_address_brand')->nullable()->default(false);
            $table->json('campaign_goals')->nullable();
            $table->longText('desired_content_notes')->nullable();
            $table->longText('personal_notes')->nullable();

            $table->boolean('offer_signed')->nullable()->default(false);
            $table->timestamp('start_of_recurring_bill')->nullable()->comment('when first content is online');
            $table->integer('billing_cycle_count')->nullable();
            $table->integer('billing_cycle_time_unit')->nullable()->default(1)->comment('1. Monthly, 2. Weekly');
            $table->double('euros_total')->nullable()->default(0.0);
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
        Schema::dropIfExists('campaigns');
    }
}
