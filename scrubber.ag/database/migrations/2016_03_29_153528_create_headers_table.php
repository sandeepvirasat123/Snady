<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headers',function(Blueprint $table){
            $table->bigIncrements('id');
            $table->integer('token_id')->unsigned();
            $table->string('token');
            $table->text('request',10000);
            $table->text('response',10000);
            $table->text('reference',10000);
            $table->text('description',1000);
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("updated_at")->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('token_id')
                ->references('id')
                ->on('tokens')
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
        //
    }
}
