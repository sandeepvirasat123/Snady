<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journals',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->smallInteger('year');
            $table->tinyInteger('month');
            $table->tinyInteger('day');
            $table->string('reference');
            $table->string('description',1000);
            $table->string('result',45);
            $table->string('suggest',45);
            $table->integer('token_id')->unsigned();
            $table->string('token',45);
            $table->integer('scrubber_id')->unsigned();
            $table->bigInteger('header_id')->unsigned();
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("updated_at")->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('token_id')
                ->references('id')
                ->on('tokens')
                ->onDelete('no action');

            $table->foreign('scrubber_id')
                ->references('id')
                ->on('scrubbers')
                ->onDelete('no action');
            $table->foreign('header_id')
                ->references('id')
                ->on('headers')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schem::dropIfExists('journal');
    }
}
