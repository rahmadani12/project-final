<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ports', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('country');
            $table->string('city')->nullable();
            $table->string('type')->nullable();
            $table->decimal('latitude',10,7)->nullable();
            $table->decimal('longitude',10,7)->nullable();
            $table->string('status')->default('Active');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ports');
    }
};