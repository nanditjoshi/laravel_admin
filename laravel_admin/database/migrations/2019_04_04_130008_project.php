
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Project extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasTable('voucher_values')) {
            Schema::create('voucher_values', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('amount');
                $table->boolean('status')->default(1);

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('project_causes')) {
            Schema::create('project_causes', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('title');
                $table->boolean('status')->default(1);

                $table->timestamps();
                $table->softDeletes();
            });
        }

        if (!Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->increments('id');
                $table->unsignedInteger('company_id')->comment("Charity");
                $table->string('title');
                $table->string('description')->nullable();
                $table->string('website')->nullable();
                $table->unsignedInteger('voucher_value_id');
                $table->boolean('status')->default(1);
                $table->dateTime('end_date');
                $table->dateTime('start_date');
                $table->string('thumbnail_image')->nullable();
                $table->string('tagline');
                $table->unsignedInteger('project_cause_id');

                $table->timestamps();
                $table->softDeletes();

                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
                $table->foreign('voucher_value_id')->references('id')->on('voucher_values')->onDelete('cascade');
                $table->foreign('project_cause_id')->references('id')->on('project_causes')->onDelete('cascade');

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
        Schema::dropIfExists('voucher_values');
        Schema::dropIfExists('project_causes');
        Schema::dropIfExists('projects');
    }
}
