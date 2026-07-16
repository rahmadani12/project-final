<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('economies', function (Blueprint $table) {

            $table->id();

            $table->foreignId('country_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->decimal('gdp', 15, 2)->nullable();

            $table->decimal('inflation', 5, 2)->nullable();

            $table->decimal('unemployment', 5, 2)->nullable();

            $table->decimal('export_value', 15, 2)->nullable();

            $table->decimal('import_value', 15, 2)->nullable();

            $table->decimal('growth', 5, 2)->nullable();

            $table->year('year');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('economies');
    }
};