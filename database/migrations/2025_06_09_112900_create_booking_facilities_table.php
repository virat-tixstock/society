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
        Schema::create('booking_facilities', function (Blueprint $table) {
            $table->id();
            $table->integer('booking_id')->default(0);
            $table->integer('building_id')->default(0);
            $table->integer('member_id')->default(0);
            $table->string('member_name')->nullable();
            $table->text('address')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('booking_facilities');
    }
};
