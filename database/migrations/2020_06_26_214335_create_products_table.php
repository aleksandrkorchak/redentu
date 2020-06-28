<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('rubric1');
            $table->string('rubric2');
            $table->unsignedBigInteger('category');
            $table->string('manufacturer');
            $table->string('name');
            $table->string('code');
            $table->text('description');
            $table->decimal('price');
            $table->unsignedTinyInteger('guarantee');
            $table->boolean('availability');
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
        Schema::dropIfExists('products');
    }
}
