<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('host_id')->nullable()->default(null);
            $table->foreign('host_id')->references('id')->on('hosts')->onDelete('set null');
            $table->boolean('branch')->default(0)->nullable();
            $table->integer('index')->nullable();
            $table->string('title')->nullable();
            $table->string('stage')->nullable();
            $table->string('img')->nullable();
            $table->tinyInteger('required')->default(1)->nullable();
            $table->string('type')->default('radio')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
