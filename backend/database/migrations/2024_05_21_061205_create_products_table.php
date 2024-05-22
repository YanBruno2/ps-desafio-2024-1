<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void

    //pode dar algum problema aqui pelo nome da variavel !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
    {

        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->integer('quantity');
            $table->float('price');
            $table->string('image');
            $table->foreignUuid('categoria_id')->references('id')->on('categories');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
