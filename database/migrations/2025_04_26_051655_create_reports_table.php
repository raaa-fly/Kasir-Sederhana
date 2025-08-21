<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal'); // <- Kolom tanggal HARUS ADA
            $table->integer('total_item');
            $table->integer('total_pemasukan');
            $table->timestamps();
        });
    }
    

     
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
