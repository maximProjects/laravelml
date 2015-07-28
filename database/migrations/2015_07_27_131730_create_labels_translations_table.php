<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('label_id');
            $table->unsignedInteger('lang_id');
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
