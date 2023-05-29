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
        Schema::create('purchasemodels', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendorid');
            $table->foreign('vendorid')->references('id')->on('vendortables');
            $table->string('requestedby');
            $table->string('department');
            $table->string('dateofdelivery');
            $table->string('transaction');
            $table->string('title');
            $table->integer('quantity');
            $table->integer('unitprice');
            $table->string('status');
            $table->string('createdby');
            $table->integer('received')->default(0);
            $table->string('receivedby');
            $table->date('canceldate')->default(now());
            $table->boolean('ishide')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchasemodels');
    }
};
