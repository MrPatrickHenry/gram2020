<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ig', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('userID');
            $table->integer('likes');
            $table->integer('followers');
            $table->integer('engagementRate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ig');
    }
}
