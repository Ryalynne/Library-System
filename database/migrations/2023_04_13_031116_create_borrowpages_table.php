<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('borrowpages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bookid');
            $table->unsignedBigInteger('studentid');
            $table->foreign('bookid')->references('id')->on('booklists');
            $table->foreign('studentid')->references('id')->on(new Expression('bma_portal.student_details'));
            $table->string('transaction');
            $table->string('bookstatus');
            $table->date('duedate');
            $table->boolean('ishide')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrowpages');
    }
};
