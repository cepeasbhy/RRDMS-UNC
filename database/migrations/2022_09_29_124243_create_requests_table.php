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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_id')->unique();
            $table->string('student_id');
            $table->string('department_id');
            $table->string('course_id');
            $table->date('release_date')->nullable();
            $table->string('status')->default('IN PROGRESS');
            $table->date('date_completed')->nullable();
            $table->string('reason_for_rejection')->nullable();
            $table->timestamps();

            $table->foreign('department_id')->references('department_id')->on('departments');
            $table->foreign('course_id')->references('course_id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
