<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserStudentgroupTable extends Migration
{
    /**
     * ДЛЯ ЧЕГО ЭТА МИГРАЦИЯ???
     * СМЫСЛ ЕЁ В БИЗНЕС ЛОГИКЕ КАКОЙ?
     */
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_studentgroup', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedInteger('studentgroup_id');
            $table->primary(['user_id', 'studentgroup_id']);

            // $table->foreign('user_id')
            //     ->references('id')
            //     ->on('users')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
                
            // $table->foreign('studentgroup_id')
            //     ->references('id')
            //     ->on('student_groups')
            //     ->onUpdate('cascade')
            //     ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_studentgroup');
    }
}
