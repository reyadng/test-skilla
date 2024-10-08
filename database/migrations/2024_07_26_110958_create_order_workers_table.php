<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_workers', function (Blueprint $table) {
            $table->foreignId('worker_id')
                ->constrained('workers')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->foreignId('order_id')
                ->constrained('orders')
                ->restrictOnDelete()
                ->cascadeOnUpdate();
            $table->integer('amount');
            $table->timestamps();

            $table->unique(['order_id', 'worker_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_workers');
    }
};
