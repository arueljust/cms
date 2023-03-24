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
        Schema::create('absensi_ud', function (Blueprint $table) {
            $table->id();
            $table->string('tanggal');
            $table->unsignedBigInteger('siswas_id');
            $table->unsignedBigInteger('kelas_id');
            $table->string('status');
            $table->foreign('siswas_id')->references('id')->on('siswas')->onDelete('cascade');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
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
        Schema::dropIfExists('absensi_ud');
    }
};
