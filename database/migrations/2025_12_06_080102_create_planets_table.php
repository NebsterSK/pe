<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('planets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->integer('diameter')->nullable(false)->unsigned()->comment('The diameter of this planet in kilometers.');
            $table->integer('rotation_period')->nullable(false)->unsigned()->comment('The number of standard hours it takes for this planet to complete a single rotation on its axis.');
            $table->integer('orbital_period')->nullable(false)->unsigned()->comment('The number of standard days it takes for this planet to complete a single orbit of its local star.');
            $table->string('gravity')->nullable(false)->comment('A number denoting the gravity of this planet, where "1" is normal or 1 standard G. "2" is twice or 2 standard Gs. "0.5" is half or 0.5 standard Gs.');
            $table->bigInteger('population')->nullable(false)->unsigned();
            $table->string('climate')->nullable(false)->comment('The climate of this planet. Comma separated if diverse.');
            $table->string('terrain')->nullable(false)->comment('The terrain of this planet. Comma separated if diverse.');
            $table->integer('surface_water')->nullable(false)->unsigned()->comment('The percentage of the planet surface that is naturally occurring water or bodies of water.');
            $table->timestamps();

            $table->unique('name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('planets');
    }
};
