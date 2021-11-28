<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();

            $table->string('name');
            $table->mediumText('description');
            $table->unsignedInteger('cost');
            $table->unsignedInteger('retail');
            $table->boolean('active')->default(true);
            /**
             * @tofo Move default to config/env variable
             */
            $table->boolean('vat')->default(false);
            $table->foreignId('category_id')->nullable()->index()->constrained()->nullOnDelete();
            $table->foreignId('range_id')->nullable()->index()->constrained()->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
