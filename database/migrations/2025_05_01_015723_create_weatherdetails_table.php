<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWeatherdetailsTable extends Migration
{
    public function up()
    {
        Schema::create('weatherdetails', function (Blueprint $table) {
            $table->id();
            $table->string('city');
            $table->float('temperature');
            $table->string('description')->nullable();
            $table->string('icon')->nullable();
            $table->integer('humidity');
            $table->string('wind_speed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('weatherdetails');
    }
}
