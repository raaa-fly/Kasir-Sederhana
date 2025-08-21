<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');  // Pastikan ada kolom nama
            $table->text('alamat');
            $table->string('nomor_telepon', 15);
            $table->timestamps();
        });
        
        
    }

    public function down()
    {
        Schema::dropIfExists('pelanggans');
    }
};

