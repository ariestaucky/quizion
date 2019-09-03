<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTestTakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_takers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('name', 20);
            $table->string('status')->default('registered');
            $table->unsignedBigInteger('quiz_id');
            $table->Integer('score');
            $table->Integer('score1')->nullable();
            $table->Integer('score2')->nullable();
            $table->Integer('attemp')->default(0);
            $table->timestamps();

            $table->foreign('quiz_id')
            ->references('id')
            ->on('quizzes')
            ->onUpdate('cascade')
            ->onDelete('cascade');

            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onUpdate('cascade')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('test_takers');
    }
}
