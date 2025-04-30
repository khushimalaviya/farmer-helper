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
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('soil_type', ['Sandy', 'Loamy', 'Clayey','Black','Red','Alluvial']);
            $table->decimal('land_area', 10, 2);
            // $table->enum('land_area_unit', ['Acres', 'Hectares', 'Square Meters']);
            $table->enum('water_source', ['Well', 'Rainwater', 'Canal', 'Borewell', 'River']);
            $table->enum('season', ['Kharif', 'Rabi', 'Zaid','Spring','Autumn']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('farms');
    }
};
