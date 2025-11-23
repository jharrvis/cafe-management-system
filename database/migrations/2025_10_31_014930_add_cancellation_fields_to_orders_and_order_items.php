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
        // Add cancellation fields to orders table
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_cancelled')->default(false)->after('status');
            $table->text('cancellation_reason')->nullable()->after('is_cancelled');
            $table->timestamp('cancelled_at')->nullable()->after('cancellation_reason');
        });

        // Add cancellation fields to order_items table
        Schema::table('order_items', function (Blueprint $table) {
            $table->boolean('is_cancelled')->default(false)->after('subtotal');
            $table->text('cancellation_reason')->nullable()->after('is_cancelled');
            $table->timestamp('cancelled_at')->nullable()->after('cancellation_reason');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['is_cancelled', 'cancellation_reason', 'cancelled_at']);
        });

        Schema::table('order_items', function (Blueprint $table) {
            $table->dropColumn(['is_cancelled', 'cancellation_reason', 'cancelled_at']);
        });
    }
};
