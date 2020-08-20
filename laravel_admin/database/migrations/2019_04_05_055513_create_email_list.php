<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmailList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('email_lists')) {
            Schema::create('email_lists', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_id')->comment("Participating Company - organization");

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            });
        }


        if (!Schema::hasTable('email_list_values')) {
            Schema::create('email_list_values', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('email_list_id');
                $table->string('email')->unique();
                $table->dateTime('created_date_time');
                $table->boolean('opt-out status')->default(0);

                $table->softDeletes();
                $table->foreign('email_list_id')->references('id')->on('email_lists')->onDelete('cascade');
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
        Schema::dropIfExists('email_lists');
        Schema::dropIfExists('email_list_values');
    }
}
