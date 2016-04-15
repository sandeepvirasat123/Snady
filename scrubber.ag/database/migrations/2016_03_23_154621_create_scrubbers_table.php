<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScrubbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrubbers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('name_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('mode_id')->unsigned();
            $table->integer('scrubb_instance_id')->unsigned();
            $table->boolean('isLinked')->default(true);
            $table->boolean('isEnabled')->default(true);
            $table->string('description')->nullable();
            $table->rememberToken();
            $table->timestamp("created_at")->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("updated_at")->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));



            $table->foreign('name_id')
                ->references('id')
                ->on('scrubberNames')
                ->onDelete('no action');
            $table->foreign('type_id')
                ->references('id')
                ->on('scrubberTypes')
                ->onDelete('no action');
            $table->foreign('mode_id')
                ->references('id')
                ->on('scrubberModes')
                ->onDelete('no action');
            /*
            $table->foreign('scrubb_instance_id')
                ->references('id')
                ->on('scrubb_instance')
                ->onDelete('no action');
            */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scrubbers');
    }
}
