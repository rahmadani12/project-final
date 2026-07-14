<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('weather_data', function (Blueprint $table) {

            $table->id();

            $table->foreignId('country_id')
                  ->nullable()
                  ->constrained('countries')
                  ->nullOnDelete();

            $table->string('city');

            $table->decimal('temperature',5,2);

            $table->integer('humidity');

            $table->decimal('wind_speed',5,2);

            $table->string('weather');

            $table->timestamp('updated_at_weather')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('weather_data');
    }
};