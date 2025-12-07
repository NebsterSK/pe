<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logbook_entries', function (Blueprint $table) {
            $table->id();
            $table->enum('mood', ['ok', 'happy', 'sad', 'depressed', 'determined', 'tired', 'energized'])->nullable(false);
            $table->enum('weather', ['clear', 'sunny', 'cloudy', 'rainy', 'stormy', 'snowy', 'windy'])->nullable(false);
            $table->decimal('latitude', 10, 8)->nullable(false);
            $table->decimal('longitude', 11, 8)->nullable(false);
            $table->integer('supplies_for_days')->nullable(false)->unsigned()->comment('Number of days until supplies run out.');
            $table->string('note')->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logbook_entries');
    }
};
