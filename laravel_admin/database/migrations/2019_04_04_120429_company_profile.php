<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CompanyProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('company_profile')) {
            Schema::create('company_profile', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_id')->unique();
                $table->text('address1');
                $table->text('address2');
                $table->string('logo');
                $table->text('description');
                $table->integer('phone');
                $table->string('website');
                $table->unsignedInteger('region_id');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('company_configuration')) {
            Schema::create('company_configuration', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_id')->unique();
                $table->string('stmp_out');
                $table->string('stmp_in');
                $table->string('domain');
                $table->integer('port');
                $table->string('username');
                $table->string('password');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
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
        Schema::dropIfExists('company_profile');
        Schema::dropIfExists('company_configuration');
    }
}
