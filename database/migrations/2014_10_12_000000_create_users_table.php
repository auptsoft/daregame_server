<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');           
            $table->string('email',100)->unique();
            $table->string('username', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('profile_picture_url')->default('');
            $table->string('cover_picture_url')->default('');
            $table->string('bio')->default('');
            $table->string('country')->default('');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
