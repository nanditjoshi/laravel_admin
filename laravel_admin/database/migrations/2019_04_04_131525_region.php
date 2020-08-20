<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Region extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('currencies')) {
            Schema::create('currencies', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->unique();
                $table->string('abbrevation')->unique();
                $table->boolean('status')->default(1);

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('regions')) {
            Schema::create('regions', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title')->unique();
                $table->unsignedInteger('currency_id');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('cascade');
            });
        }

        Schema::table('company_profile', function (Blueprint $table) {
            $table->foreign('region_id')->references('id')->on('regions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('regions');
    }
}
