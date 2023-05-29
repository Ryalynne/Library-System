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
        Schema::create('studentlists', function (Blueprint $table) {
            $table->id();
            $table->string('studentno')->unique();
            $table->string('name');
            $table->string('middle');
            $table->string('lastname');
            $table->string('class');
            $table->string('studimg')->nullable(true);
            $table->string('status')->default('active');
            $table->boolean('ishide')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('studentlists');
    }
};
