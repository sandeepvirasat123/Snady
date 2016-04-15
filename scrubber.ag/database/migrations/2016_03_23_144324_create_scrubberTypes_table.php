<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScrubberTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrubberTypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 50)->unique();
            $table->string('description')->nullable();
        });

        $data = array(
            array(
                'id' => 1,
                'type' => 'person',
                'description' => 'Checks a person'
            ),
            array(
                'id' => 2,
                'type' => 'card',
                'description' => 'Checks a credit or debit card'
            ),
            array(
                'id' => 3,
                'type' => 'device',
                'description' => 'Checks a device'
            )
        );

        DB::table('scrubberTypes')->insert(
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
        Schema::dropIfExists('scrubberTypes');
    }
}
