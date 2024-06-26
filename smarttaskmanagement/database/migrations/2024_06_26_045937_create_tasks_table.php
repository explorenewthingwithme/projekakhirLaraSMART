<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task_name');
            $table->string('course_name');
            $table->date('start_date');
            $table->date('deadline');
            $table->enum('difficulty_level', ['easy', 'medium', 'hard']);
            $table->enum('importance', ['low', 'medium', 'high']);
            $table->integer('estimated_time');
            $table->enum('task_type', ['individual', 'group']);
            $table->text('additional_notes')->nullable();
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
        Schema::dropIfExists('tasks');
    }
}
