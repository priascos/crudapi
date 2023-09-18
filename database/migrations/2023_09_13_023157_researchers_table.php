<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ResearchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('researchers', function (Blueprint $table) {
            $table->id();
            $table->string('orcid',100);
            $table->string('given-names',200);
            $table->string('family-names',200);
            $table->string('keywords',200);
            $table->string('email',200);
            $table->timestamps();
            $table->unique('email');
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
        Schema::dropIfExists('researchers');
    }
}
