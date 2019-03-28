<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->string('name')->default('');
            $table->string('type');
            $table->string('description')->default('');
            $table->integer('owner_id');
            $table->string('owner_type');
            $table->string('file_name');
            $table->string('extra')->default(''); //when used with 'challenge' as owner_type it must be either; 'chanllenger' or 'challenged'
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
        Schema::dropIfExists('media');
    }
}
