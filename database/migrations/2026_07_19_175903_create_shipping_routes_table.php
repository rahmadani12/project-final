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
        Schema::create('shipping_routes', function (Blueprint $table) {

            $table->id();

            $table->foreignId('origin_port_id')
                ->constrained('ports')
                ->cascadeOnDelete();

            $table->foreignId('destination_port_id')
                ->constrained('ports')
                ->cascadeOnDelete();

            $table->integer('distance')->nullable();

            $table->string('duration')->nullable();

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipping_routes');
    }
};
