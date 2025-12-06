<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->string('birth_year')->nullable(false)->comment('The birth year of the person, using the in-universe standard of BBY or ABY - Before the Battle of Yavin or After the Battle of Yavin. The Battle of Yavin is a battle that occurs at the end of Star Wars episode IV: A New Hope.');
            $table->string('eye_color')->nullable(false)->comment('The eye color of this person. Will be "unknown" if not known or "n/a" if the person does not have an eye.');
            $table->string('gender')->nullable(false)->comment('The gender of this person. Either "Male", "Female" or "unknown", "n/a" if the person does not have a gender.'); // TODO: Enum?
            $table->string('hair_color')->nullable(false)->comment('The hair color of this person. Will be "unknown" if not known or "n/a" if the person does not have hair.');
            $table->integer('height')->nullable(false)->unsigned()->comment('The height of the person in centimeters.');
            $table->integer('mass')->nullable(false)->unsigned()->comment('The mass of the person in kilograms.');
            $table->string('skin_color')->nullable(false)->comment('The skin color of this person.');
            $table->unsignedBigInteger('planet_id')->nullable(false);
            // Intentionally skipped Species, Spaceships & Vehicles
            $table->timestamps();

            $table->foreign('planet_id')->references('id')->on('planets')->cascadeOnDelete()->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('residents');
    }
};
