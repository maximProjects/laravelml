<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeigenKeyLabelsTranslations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('labels_translations', function ($table) {
            $table->foreign('label_id')
                ->references('id')->on('labels')
                ->onDelete('cascade');

            $table->foreign('lang_id')
                ->references('id')->on('languages')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
