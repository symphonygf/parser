<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('car', function (Blueprint $table) {
            $table->id();
            $table->string('mark', 256);
            $table->string('model', 256);
            $table->string('generation', 256);
            $table->integer('year');
            $table->integer('run');
            $table->string('color');
            $table->string('body_type');
            $table->string('engine_type');
            $table->string('transmission');
            $table->string('gear_type');
            $table->integer('generation_id')->nullable();
            $table->timestamps();
            $table->index(['mark']);
            $table->index(['model']);
            $table->index(['year']);
            $table->index(['color']);
            $table->index(['mark', 'model']);
            $table->index(['mark', 'model', 'year']);
            $table->index(['mark', 'color']);
            $table->index(['model', 'color']);
            $table->index(['mark', 'model', 'color']);
            $table->index(['mark', 'model', 'year', 'color']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('car');
    }
};
