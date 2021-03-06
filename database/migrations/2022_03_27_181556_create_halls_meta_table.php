<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHallsMetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('halls_meta', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
            ->references('id')
            ->on('users')
            ->cascadeOnDelete();

            $table->foreignId('hall_id')
            ->references('id')
            ->on('halls')
            ->cascadeOnDelete();

            $table->string('meta_key');
            $table->string('meta_value', 255);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('halls_meta');
    }
}
