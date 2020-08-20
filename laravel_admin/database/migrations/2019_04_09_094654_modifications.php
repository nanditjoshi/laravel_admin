<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Modifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('email_lists', function (Blueprint $table) {
            // Removed
            if(Schema::hasColumn('email_lists', 'company_id')) {
                $table->dropForeign(['company_id']);
                $table->dropColumn('company_id');
            }

            // New field
            $table->unsignedInteger('campaign_id');
            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns')
                ->onDelete('cascade');

            // New field
            $table->boolean('is_deleted')->default(false);

        });

        Schema::table('campaigns', function (Blueprint $table) {
            if(Schema::hasColumn('campaigns', 'email_list_id')) {
                $table->dropForeign(['email_list_id']);
                $table->dropColumn('email_list_id');
            }
        });

        Schema::table('campaign_templates', function (Blueprint $table) {
            $table->unsignedInteger('campaign_id');
            $table->foreign('campaign_id')->references('id')->on('campaigns')->onDelete('cascade');
        });

        Schema::table('campaign_vouchers', function (Blueprint $table) {
            if(Schema::hasColumn('campaign_vouchers', 'redeem_email')) {
                $table->renameColumn('redeem_email', 'redeem_email_id');
            }

            if(Schema::hasColumn('campaign_vouchers', 'company_id')) {
                $table->dropColumn('company_id');
            }

            if(Schema::hasColumn('campaign_vouchers', 'created_date_time')) {
                $table->dropColumn('created_date_time');
            }
        });

        Schema::rename('campaign_projects', 'campaign_project');

        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
