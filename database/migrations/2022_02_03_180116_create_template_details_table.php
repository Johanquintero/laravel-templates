<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplateDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('template_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->references('id')->on('templates')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('sale_type_id')->references('id')->on('sale_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('type_cards');
            $table->string('invoice');
            $table->string('order_number');
            $table->float('advance');
            $table->float('previous_cost');
            $table->float('cancelation');
            $table->string('client_identification')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_phone_number')->nullable();
            $table->string('client_address')->nullable();
            $table->float('value');
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
        Schema::dropIfExists('template_details');
    }
}
