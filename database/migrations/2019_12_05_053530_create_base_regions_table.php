<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBaseRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('base_regions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('asuse_name');
            $table->integer('omnius_link');
            $table->integer('asuse_code_dep');
            $table->integer('omnius_division');
            $table->string('asuse_alias')->nullable();
            $table->string('description')->nullable();
            $table->string('id_tns_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('base_regions');
    }
}
