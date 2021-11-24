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
            $table->uuid(column: 'uuid')->unique();
            $table->string(column: 'house'); // 1234
            $table->string(column: 'street'); //street name
            $table->string(column: 'parish')->nullable(); //village ot town
            $table->string(column: 'ward')->nullable(); // town
            $table->string(column: 'district')->nullable(); //Greater Area
            $table->string(column: 'county')->nullable(); //Darbyshire County
            $table->string(column: 'postcode'); // DE56 0QF
            $table->string(column: 'country');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(table: 'locations');
    }
};
