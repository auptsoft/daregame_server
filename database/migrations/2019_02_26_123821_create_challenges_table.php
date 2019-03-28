<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallengesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('challenger_id');
            $table->integer('challenged_id');
			$table->string('title');
            $table->string('description');
            $table->double('price');
            $table->integer('category_id');
			$table->string('type')->default('paid'); //can be 'paid' or 'free'
            $table->string('accept_type'); //can be 'image' , 'video', or 'audio'. Combination are seperated with '|' e.g 'image|video'
            $table->string('content_source')->default('live'); //can be 'live', 'file', 'live|file'
            $table->timestamp('accepted_at')->nullable();
            $table->timestamp('performed_at')->nullable();
            $table->timestamp('max_acceptance_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('challenges');
    }
}
