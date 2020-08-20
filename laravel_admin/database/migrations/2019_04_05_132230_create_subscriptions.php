<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('subscriptions')) {
            Schema::create('subscriptions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('plan_name');
                $table->unsignedInteger('cost_year');
                $table->unsignedInteger('limit_value');

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('company_subscriptions')) {
            Schema::create('company_subscriptions', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_id');
                $table->unsignedInteger('subscription_id');

                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
                $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('subscription_transactions')) {
            Schema::create('subscription_transactions', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_subscription_id');
                $table->dateTime('transaction_date');
                $table->unsignedInteger('transaction_value');
                $table->unsignedInteger('acknowledge number');

                $table->foreign('company_subscription_id')->references('id')->on('company_subscriptions')->onDelete('cascade');

                $table->timestamps();
                $table->softDeletes();
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
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('company_subscriptions');
        Schema::dropIfExists('subscription_transactions');
    }
}
