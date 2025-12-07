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
            $table->text('mood')->nullable(false);
            $table->text('weather')->nullable(false);
            $table->text('latitude')->nullable(false);
            $table->text('longitude')->nullable(false);
            $table->text('supplies_for_days')->nullable(false)->comment('Number of days until supplies run out.');
            $table->text('note')->nullable(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logbook_entries');
    }
};
