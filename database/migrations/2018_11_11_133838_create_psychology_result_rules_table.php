<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePsychologyResultRulesTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('psychology_result_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
            $table->float('average_value', 8, 3);
            $table->float('error_value', 8, 3);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('psychology_result_rules');
    }
}
