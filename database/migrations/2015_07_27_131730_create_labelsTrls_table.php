<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTrlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labelsTrls', function (Blueprint $table) {
            $table->increments('id');
            $table->string('label_id');
            $table->string('lang_id');
            $table->string('text');
            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('labelsTrls');
    }
}
