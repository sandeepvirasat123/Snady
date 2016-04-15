<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScrubberModesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrubberModes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mode', 50)->unique();
            $table->string('description')->nullable();
        });

        $data = array(
            array(
                'id' => 1,
                'mode' => 'standard',
                'description' => 'Standard checks'
            ),
            array(
                'id' => 2,
                'mode' => 'medium',
                'description' => 'Medium level checks'
            ),
            array(
                'id' => 3,
                'mode' => 'advanced',
                'description' => 'Performs complex checks'
            )
        );

        DB::table('scrubberModes')->insert(
            $data
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scrubberModes');
    }
}
