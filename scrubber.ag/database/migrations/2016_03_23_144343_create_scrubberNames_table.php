<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateScrubberNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scrubberNames', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->string('description')->nullable();
        });

        $data = array(
            array(
                'id' => 1,
                'name' => 'iovation',
                'description' => 'Iovation device scrubber'
            ),
            array(
                'id' => 2,
                'name' => 'acuitytec',
                'description' => 'AcuityTec Scrubber'
            )

        );
        DB::table('scrubberNames')->insert(
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
        Schema::dropIfExists('scrubberNames');
    }
}
