<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('gender');
            $table->string('phone');
            $table->unsignedBigInteger('nationality_id')->unsigned();
            $table->unsignedBigInteger('document_type_id')->unsigned();
            $table->string('document_number');
            $table->unsignedBigInteger('employee_id')->unsigned()->nullable();
            $table->string('visiting')->nullable();
            $table->string('purpose');
            $table->unsignedBigInteger('visitor_card_id')->unsigned();
            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();
            $table->foreign('nationality_id')->references('id')->on('nationalities');
            $table->foreign('document_type_id')->references('id')->on('document_types');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('visitor_card_id')->references('id')->on('visitor_cards');

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
        Schema::dropIfExists('visitors');
    }
}
