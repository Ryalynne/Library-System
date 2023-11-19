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
        Schema::create('booklists', function (Blueprint $table) {
            $table->id();
            $table->text('title')->nullable();
            $table->text('author')->nullable();

            // $table->string('department')->nullable();

            $table->string('department')->nullable();
            $table->string('subject')->nullable();


            $table->string('copyright')->nullable();
            $table->string('accession')->nullable();
            $table->string('callnumber')->nullable();

            // $table->string('subject')->nullable();
            $table->boolean('ishide')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booklists');
    }
};
