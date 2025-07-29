<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parkings', function (Blueprint $table) {
            $table->id();
            $table->integer('parking_slot')->default(0);
            $table->string('vehicle_type')->nullable();
            $table->integer('building_id')->default(0);
            $table->integer('unit_id')->default(0);
            $table->string('vehicle_number')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('description')->nullable();
            $table->integer('parent_id')->default(0);
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
        Schema::dropIfExists('parkings');
    }
};
