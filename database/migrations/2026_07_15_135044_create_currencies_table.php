<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {

            $table->id();

            $table->foreignId('country_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Data mata uang
            $table->string('code');
            $table->string('name');
            $table->string('symbol')->nullable();

            // Data kurs dari ExchangeRate API
            $table->decimal('exchange_rate', 15, 6)->nullable();

            // Waktu update kurs terakhir
            $table->timestamp('updated_at_rate')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};