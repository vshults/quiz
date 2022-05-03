<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id')->nullable()->default(null);
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('set null');
            $table->unsignedBigInteger('branch_id')->nullable()->default(null);
            $table->foreign('branch_id')->references('id')->on('questions')->onDelete('set null');
            $table->unsignedBigInteger('host_id')->nullable()->default(null);
            $table->foreign('host_id')->references('id')->on('hosts')->onDelete('set null');
            $table->string('answer')->nullable();
            $table->tinyInteger('selection')->default(0)->nullable();
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
        Schema::dropIfExists('answer');
    }
}
