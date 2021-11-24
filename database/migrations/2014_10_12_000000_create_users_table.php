<?php
declare(strict_types=1);

use Domains\Customer\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->uuid(column: 'uuid')->unique();
            $table->string(column: 'first_name');
            $table->string(column: 'last_name')->nullable();
            $table->string(column: 'email')->unique();
            $table->string(column: 'password');
            $table->rememberToken();

            $table->foreignIdFor(model: Location::class, column: 'billing_id')->nullable()->index();
            $table->foreignIdFor(model: Location::class, column: 'shipping_id')->nullable()->index();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
