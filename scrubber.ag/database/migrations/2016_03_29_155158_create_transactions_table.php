<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->string('request',10000);
            $table->string('response',10000);
            $table->string('status',25);
            $table->string('name',45);
            $table->string('type',45);
            $table->string('mode',45);
            $table->smallInteger('year');
            $table->tinyInteger('month');
            $table->tinyInteger('day');
            $table->string('pin',45);
            $table->integer('pin_id');
            $table->string('referer',500);
            $table->string('result',45);
            $table->string('suggest',45);

            $table->bigInteger('journal_id')->unsigned();
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("updated_at")->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('journal_id')
                ->references('id')
                ->on('journals')
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
        Schem::dropIfExists('transactions');
    }
}
