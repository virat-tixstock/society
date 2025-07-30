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
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->integer('facility')->default(0);
            $table->integer('booking_id')->default(0);
            $table->timestamp('start_date')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamp('deposite_date')->nullable();
            $table->float('total_cost')->default(0);
            $table->float('deposite_cost')->default(0);
            $table->json('maintenance_charge')->nullable();
            $table->float('maintenance_amount')->default(0);
            $table->string('payment_type')->default(0);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('booking_details');
    }
};
