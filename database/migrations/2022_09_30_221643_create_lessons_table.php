<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->index();
            $table->foreignId('teacher_id')->index();
            $table->foreignId('student_id')->index();
            $table->foreignId('subject_id')->index();
            $table->integer('number_of_lesson');
            $table->dateTime('date');
            $table->dateTime('end-date');
            $table->string('note');
            $table->string('status')->default('waiting');
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
        Schema::dropIfExists('lessons');
    }
};
