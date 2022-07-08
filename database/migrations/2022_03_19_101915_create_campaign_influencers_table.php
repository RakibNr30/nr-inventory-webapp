<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignInfluencersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaign_influencers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('campaign_id')->nullable();
            $table->unsignedBigInteger('influencer_id')->nullable();
            $table->json('brand_ids')->nullable();
            $table->json('denied_brand_ids')->nullable();
            $table->json('brand_denied_reasons')->nullable();
            $table->timestamp('available_until')->nullable();
            $table->json('content_types')->nullable();
            $table->double('fee')->nullable()->default(0);
            $table->integer('cycle_count')->nullable()->comment('(Cooperation Duration');
            $table->timestamp('start_date')->nullable();
            $table->longText('personal_notes')->nullable();
            $table->tinyInteger('accept_status')->nullable()->default(0);
            $table->tinyInteger('campaign_accept_status_by_influencer')->nullable()->default(0);
            $table->longText('denied_reason')->nullable();
            $table->boolean('is_add_to_favourite')->nullable()->default(false);
            $table->boolean('is_reported')->nullable()->default(false);
            $table->longText('report_details')->nullable();
            $table->string('individual_coupon_code')->nullable();
            $table->string('individual_swipe_up_link')->nullable();
            $table->string('shipping_address')->nullable();
            $table->string('internal_individual_coupon_code')->nullable();
            $table->string('internal_individual_swipe_up_link')->nullable();
            $table->boolean('is_content_uploaded')->nullable()->default(false);
            $table->boolean('admin_is_content_uploaded')->nullable()->default(false);
            $table->json('feedback')->nullable();
            $table->tinyInteger('briefing_reminder')->nullable()->default(0);
            $table->json('briefing_reminders_at')->nullable();
            $table->tinyInteger('content_reminder')->nullable()->default(0);
            $table->json('content_reminders_at')->nullable();
            $table->tinyInteger('missing_content_reminder')->nullable()->default(0);
            $table->json('missing_content_reminders_at')->nullable();
            $table->unsignedBigInteger('campaign_manager_id')->nullable();
            $table->boolean('is_pre_selected')->nullable()->default(false);

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
        Schema::dropIfExists('campaign_influencers');
    }
}
