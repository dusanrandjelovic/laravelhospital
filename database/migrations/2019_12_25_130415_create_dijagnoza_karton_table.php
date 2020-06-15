<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDijagnozaKartonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dijagnoza_karton', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dijagnoza_id');
          $table->unsignedBigInteger('karton_id');
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
        Schema::dropIfExists('dijagnoza_karton');
    }
}
