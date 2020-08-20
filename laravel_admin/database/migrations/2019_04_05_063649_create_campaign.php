<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('campaigns')) {
            Schema::create('campaigns', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_id')->comment("Participating Company");
                $table->unsignedInteger('email_list_id');
                $table->string('title');
                $table->dateTime('start_date');
                $table->dateTime('end_date');
                $table->integer('total_vouchers');
                $table->unsignedInteger('delivery_method')->comment("1=>52L,2=>third party,3=>manual");
                $table->string('hash_code');
                $table->unsignedInteger('voucher_value_id');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
                $table->foreign('voucher_value_id')->references('id')->on('voucher_values')->onDelete('cascade');
                $table->foreign('email_list_id')->references('id')->on('email_lists')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('campaign_templates')) {
            Schema::create('campaign_templates', function (Blueprint $table) {
                $table->increments('id');
                $table->string('from_email');
                $table->string('subject');
                $table->text('body');

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('campaign_projects')) {
            Schema::create('campaign_projects', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('campaign_id');
                $table->unsignedInteger('project_id');

                $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
                $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('campaign_vouchers')) {
            Schema::create('campaign_vouchers', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('campaign_id');
                $table->string('voucher_code');
                $table->dateTime('created_date_time')->nullable();
                $table->boolean('redeem_status')->default(0);
                $table->dateTime('redeem_date')->nullable();
                $table->string('redeem_IP')->nullable();
                $table->unsignedInteger('redeem_email')->nullable();
                $table->unsignedInteger('redeem_project_id')->nullable();

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
                $table->foreign('redeem_email')->references('id')->on('email_list_values')->onDelete('cascade');
                $table->foreign('redeem_project_id')->references('id')->on('projects')->onDelete('cascade');

            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
        Schema::dropIfExists('campaign_templates');
        Schema::dropIfExists('campaign_projects');
        Schema::dropIfExists('campaign_vouchers');
    }
}
