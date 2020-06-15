<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacijentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacijents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ime');
            $table->string('prezime');
            $table->string('pol');
            $table->string('datum_rodjenja');
            $table->string('adresa');
            $table->integer('user_id');
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
        Schema::dropIfExists('pacijents');
    }
}
