<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function(Blueprint $table)
        {
            $table->dropUnique('companies_type_unique');
        });

        Schema::table('company_profiles', function (Blueprint $table) {
            $table->text('address1')->nullable()->change();
            $table->text('address2')->nullable()->change();
            $table->unsignedInteger('region_id')->nullable()->change();
            $table->string('logo')->nullable()->change();
            $table->string('phone',15)->change();
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
