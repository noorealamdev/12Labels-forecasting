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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Supplier::class);
            $table->string('title')->nullable();
            $table->string('sku')->unique();
            $table->string('upcAsinFnsku')->nullable();
            $table->integer('whInventory')->nullable();
            $table->integer('fbaInventory')->nullable();
            $table->integer('amazonInventory')->nullable();
            $table->integer('inboundOrders')->nullable();
            $table->integer('totalInventory')->nullable();
            $table->integer('thirtyDaysSales')->nullable();
            $table->integer('ninetyDayAmazon')->nullable();
            $table->decimal('coverInMonths')->nullable();
            $table->decimal('coverInMonthsInbound')->nullable();
            $table->integer('orderQuantity')->nullable();
            $table->integer('unitsToOrder')->nullable();
            $table->string('needAirShip')->nullable();
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
        Schema::dropIfExists('items');
    }
};
