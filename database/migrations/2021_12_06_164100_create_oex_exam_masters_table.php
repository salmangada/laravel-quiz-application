<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOexExamMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oex_exam_masters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->string('category')->nullable();
            $table->string('exam_date')->nullable();
            $table->string('exam_duration')->nullable();
            $table->string('status')->nullable(); 
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
        Schema::dropIfExists('oex_exam_masters');
    }
}
