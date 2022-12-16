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
        Schema::create('requested_archives', function (Blueprint $table) {
            $table->id();
            $table->string('request_id');
            $table->string('staff_id');
            $table->string('archive_id');
            $table->integer('status')->default(0);
            $table->string('reason_for_rejection')->nullable();
            $table->timestamps();

            $table->foreign('staff_id')->references('staff_id')->on('staff');
            $table->foreign('archive_id')->references('archive_id')->on('archives');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requested_archives');
    }
};
