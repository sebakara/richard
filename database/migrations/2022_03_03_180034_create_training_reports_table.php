<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_reports', function (Blueprint $table) {
            $table->increments('id');
            $table->string('names');
            $table->string('gender');
            $table->string('phone_number');
            $table->string('nationalId');
            $table->string('district');
            $table->string('sector');
            $table->string('cell');
            $table->string('date_of_training');
            $table->integer('report_id');
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
        Schema::dropIfExists('training_reports');
    }
}
