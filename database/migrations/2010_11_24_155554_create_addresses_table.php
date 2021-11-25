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
            $table->string(column: 'label'); //Home/Office/ Head Office/ Village  House
            $table->boolean(column: 'billing')->default( false); //Billing/Shipping

            $table->foreignIdFor(model: User::class, column: 'user_id')->index();
            $table->foreignIdFor(model: Location::class, column: 'location_id')->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
