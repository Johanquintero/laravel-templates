<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->id();

            $table->foreignId('template_type_id')->references('id')->on('template_types')->onDelete('cascade')->onUpdate('cascade');
            $table->string('user_store_name');
            $table->string('user_store_identification');
            $table->string('store_name');
            $table->string('store_city');
            $table->string('store_address');
            $table->integer('store_operation_center');
            $table->date('date')->format('Y/m/d');
            $table->string('observation', 255);
            $table->string('initial_invoice');
            $table->string('final_invoice');
            $table->float('total_sales');
            $table->float('total_iva');
            $table->float('total_ipc');
            $table->float('total_bag_tax');
            $table->float('total_delivery');
            $table->float('value');
            $table->json('url_images');
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
        Schema::dropIfExists('templates');
    }
}
