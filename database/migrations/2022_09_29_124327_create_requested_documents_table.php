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
        Schema::create('requested_documents', function (Blueprint $table) {
            $table->id();
            $table->string('request_id');
            $table->string('diploma');
            $table->string('certificate');
            $table->string('authentication');
            $table->string('transfer_credentials');
            $table->double('total_fee',8,2);
            $table->timestamps();

            $table->foreign('request_id')->references('request_id')->on('requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requested_documents');
    }
};
