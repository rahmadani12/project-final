<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('risk_scores', function (Blueprint $table) {

            $table->id();

            $table->foreignId('country_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->integer('weather_score')->default(0);

            $table->integer('economy_score')->default(0);

            $table->integer('news_score')->default(0);

            $table->integer('total_score')->default(0);

            $table->enum('risk_level',[
                'Low',
                'Medium',
                'High'
            ]);

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('risk_scores');
    }
};