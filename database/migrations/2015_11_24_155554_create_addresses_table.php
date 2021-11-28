<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Domains\Customer\Models\User;
use Domains\Customer\Models\Location;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('label'); //Home/Office/ Head Office/ Village  House
            $table->boolean('billing')->default( false); //Billing/Shipping

            $table->foreignId('user_id')->index()->constrained();
            $table->foreignId('location_id')->index()->constrained();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
