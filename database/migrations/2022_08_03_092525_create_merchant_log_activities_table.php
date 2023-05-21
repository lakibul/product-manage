<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchant_log_activities', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('url');
            $table->string('method');
            $table->string('agent')->nullable();
            $table->integer('merch_id')->nullable();
            $table->morphs('loggable');
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
        Schema::dropIfExists('merchant_log_activities');
    }
};
