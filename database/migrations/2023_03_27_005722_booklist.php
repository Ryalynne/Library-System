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
            $table->string('title');
            $table->string('author')->nullable();

            // $table->string('department')->nullable();
      
            $table->unsignedBigInteger('department')->nullable();
            $table->foreign('department')->references('id')->on('department_lists');

   
            $table->unsignedBigInteger('subject')->nullable();
            $table->foreign('subject')->references('id')->on('subject_lists');


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
