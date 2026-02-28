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
        Schema::create('rides', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('pickup_address');
            $table->double('pickup_lat');
            $table->double('pickup_lng');
            $table->string('drop_address');
            $table->double('drop_lat');
            $table->double('drop_lng');
            $table->double('distance_kg')->nullable();
            $table->date('date');
            $table->time('time');
            $table->decimal('price',8,2);
            $table->integer('total_seats');
            $table->integer('available_seats');
            $table->string('vehicle_number');
            $table->string('license_number');
            $table->enum('status', ['Upcoming', 'Ongoing', 'Completed', 'Cancelled'])->default('Upcoming');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rides');
    }
};
