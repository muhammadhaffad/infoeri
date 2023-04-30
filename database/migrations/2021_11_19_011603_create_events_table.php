<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedSmallInteger('type_id')->nullable();
            $table->foreign('type_id')->references('id')->on('types')->onDelete('set null');

            $table->string('title');
            $table->text('descriptioin');
            $table->string('eventstart')->nullable();
            $table->string('eventend')->nullable();
            $table->string('link')->nullable();
            $table->string('contact')->nullable();
            $table->text('address')->nullable();
            $table->datetime('dateCreated')->nullable();
            $table->datetime('dateUpdated')->nullable();
            $table->datetime('dateDeleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
