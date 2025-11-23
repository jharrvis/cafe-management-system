<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('text'); // text, number, boolean, json
            $table->timestamps();
        });

        // Insert default settings
        DB::table('settings')->insert([
            ['key' => 'app_name', 'value' => 'Kantin Sekolah', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cafe_name', 'value' => 'Kantin Sekolah', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cafe_description', 'value' => 'Sistem Pemesanan Makanan Kantin Sekolah', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cafe_address', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'cafe_phone', 'value' => '', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'operating_hours', 'value' => '07:00 - 15:00', 'type' => 'text', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'max_order_per_day', 'value' => '10', 'type' => 'number', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'order_enabled', 'value' => '1', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
