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
        // Add the new username column (nullable first)
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after('email')->unique();
        });

        // Copy existing nisn values to username column
        \DB::statement('UPDATE users SET username = nisn WHERE nisn IS NOT NULL');

        // Drop the old nisn column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nisn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Add back the nisn column
        Schema::table('users', function (Blueprint $table) {
            $table->string('nisn')->nullable()->after('email');
        });

        // Copy data back from username to nisn
        \DB::statement('UPDATE users SET nisn = username');

        // Drop the username column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
