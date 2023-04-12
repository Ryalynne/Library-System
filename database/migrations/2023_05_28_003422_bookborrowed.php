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
        Schema::create('bookborrowed', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookid');
            $table->unsignedBigInteger('studentid');

            $table->foreign('bookid')->references('id')->on('booklists');

            $table->foreign('studentid')->references('id')->on('studentlists');

            $table->integer('borrowedcopies');
            $table->date('dateborrowed');
            $table->date('duedata');
            $table->boolean('ishide')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookborrowed');
    }
};
