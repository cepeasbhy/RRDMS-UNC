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
            $table->json('diploma')->nullable();
            $table->json('transcript_of_record')->nullable();
            $table->json('certificate')->nullable();
            $table->json('copy_of_grades')->nullable();
            $table->json('authentication')->nullable();
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
