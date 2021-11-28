<?php
declare(strict_types=1);

namespace Domains\Catalog\Models\Product;

use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Product extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'name',
        'description',
        'cost',
        'retail',
        'active',
        'vat',
        'category_id',
        'range_id',
    ];

    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

}
