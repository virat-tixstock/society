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
        Schema::create('visitors', function (Blueprint $table) {
            $table->id();
            $table->integer('building_id')->default(0);
            $table->integer('floor_id')->default(0);
            $table->integer('unit_id')->default(0);
            $table->integer('phone_no')->default(0);
            $table->string('visitor_name');
            $table->string('type');
            $table->dateTime('visit_datetime');
            $table->dateTime('end_datetime');
            $table->text('purpose')->nullable();
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
        Schema::dropIfExists('visitors');
    }
};
