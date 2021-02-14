<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentgroupExamScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('studentgroup_exam_scores', function (Blueprint $table) {
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("course_id");
            // $table->unsignedBigInteger("studentgroup_id");
            $table->integer("score")->default(5);

            $table->foreign("student_id")->references('id')->on('users');
            $table->foreign("course_id")->references('id')->on('courses');
            // $table->foreign("studentgroup_id")->references('id')->on('student_groups');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_scores');
    }
}
