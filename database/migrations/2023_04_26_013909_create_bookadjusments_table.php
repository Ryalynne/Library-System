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
        Schema::create('bookadjusments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookid');
            $table->foreign('bookid')->references('id')->on('booklists');
            $table->string('action');
            $table->string('performby');
            $table->integer('number_adjust');
            $table->string('comment');
            $table->boolean('ishide')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookadjusments');
    }
};
