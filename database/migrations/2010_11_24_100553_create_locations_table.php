<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('locations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('house'); // 1234
            $table->string('street'); //street name
            $table->string('parish')->nullable(); //village ot town
            $table->string('ward')->nullable(); // town
            $table->string('district')->nullable(); //Greater Area
            $table->string('county')->nullable(); //Darbyshire County
            $table->string('postcode'); // DE56 0QF
            $table->string('country');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
