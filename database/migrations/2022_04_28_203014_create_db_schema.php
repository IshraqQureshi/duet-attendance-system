<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDbSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->string('code', 256);
            $table->timestamps();
        });

        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->timestamps();
        });

        Schema::create('batches', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('current_semester');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->foreign('current_semester')->references('id')->on('semesters');
            $table->timestamps();
        });

        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 256);
            $table->string('last_name', 256);
            $table->unsignedBigInteger('qualification');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments');
            $table->timestamps();
        });

        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('name', 256);
            $table->unsignedBigInteger('type');  
            $table->unsignedBigInteger('semester_id');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('semester_id')->references('id')->on('semesters');
            $table->foreign('teacher_id')->references('id')->on('teachers');
            $table->timestamps();
        });

        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 256);
            $table->string('last_name', 256);
            $table->string('roll_no', 256);
            $table->unsignedBigInteger('section');
            $table->unsignedBigInteger('batch_id');
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->timestamps();
        });

        Schema::create('time_tables', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('batch_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('days');
            $table->time('start_time');
            $table->time('end_time');
            $table->unsignedBigInteger('section_id');
            $table->foreign('batch_id')->references('id')->on('batches');
            $table->foreign('subject_id')->references('id')->on('subjects');
            $table->foreign('department_id')->references('id')->on('departments');
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
        Schema::dropIfExists('departments');
        Schema::dropIfExists('semesters');
        Schema::dropIfExists('batches');
        Schema::dropIfExists('teachers');
        Schema::dropIfExists('subjects');
        Schema::dropIfExists('students');
        Schema::dropIfExists('time_tables');
    }
}
