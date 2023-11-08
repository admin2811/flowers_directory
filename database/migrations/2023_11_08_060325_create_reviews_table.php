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
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('ReviewID');
            $table->unsignedInteger('BookID');
            $table->foreign('BookID')->references('BookID')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('UserID');
            $table->foreign('UserID')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedTinyInteger('Rating');
            $table->string('ReviewText');
            $table->date('ReviewDate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
