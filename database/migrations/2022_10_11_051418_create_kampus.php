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
        Schema::create('kampus', function (Blueprint $table) {
            $table->id();
            $table->string("nama");
            $table->string("logo");
            $table->string("akreditasi");
            $table->string("status_kampus"); ///pts/ptn dll
            $table->string("jenis");
            $table->string("no_telepon");
            $table->string("fax");
            $table->string("alamat");
            $table->string("link_alamat");
            $table->string("link_web_kampus");
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
        Schema::dropIfExists('kampus');
    }
};
