<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('wallet_id');
            $table->double('amount_added', 10, 2)->default(0);
            $table->double('amount_removed', 10, 2)->default(0);
            $table->string('key');
            $table->string('comment')->default('');
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
        Schema::dropIfExists('wallet_events');
    }
}
