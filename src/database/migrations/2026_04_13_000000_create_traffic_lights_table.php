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
        Schema::create('traffic_lights', function (Blueprint $table) {
            $table->id();
            $table->string('nama_persimpangan');
            $table->enum('status', ['merah', 'kuning', 'hijau'])->default('merah');
            $table->integer('durasi_merah')->default(60);
            $table->integer('durasi_kuning')->default(10);
            $table->integer('durasi_hijau')->default(60);
            $table->enum('mode', ['otomatis', 'manual'])->default('otomatis');
            $table->timestamp('last_changed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traffic_lights');
    }
};
