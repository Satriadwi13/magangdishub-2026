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
        Schema::table('traffic_lights', function (Blueprint $table) {
            $table->string('latitude')->nullable()->after('nama_persimpangan');
            $table->string('longitude')->nullable()->after('latitude');
            $table->string('cctv_url')->nullable()->after('longitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('traffic_lights', function (Blueprint $table) {
            $table->dropColumn(['latitude', 'longitude', 'cctv_url']);
        });
    }
};
