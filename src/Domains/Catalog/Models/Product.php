<?php
declare(strict_types=1);

namespace Domains\Catalog\Models;

use Database\Factories\ProductFactory;
use Domains\Catalog\Models\Builders\ProductBuilder;
use Domains\Catalog\Models\Category;
use Domains\Catalog\Models\Range;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    protected $casts = [
        'active' => 'boolean',
        'vat' => 'boolean',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            Category::class,
            'category_id'
        );
    }

    public function range(): BelongsTo
    {
        return $this->belongsTo(
            Range::class,
            'range_id'
        );
    }

    public function variants(): HasMany
    {
        return $this->hasMany(
            Variant::class,
            'product_id'
        );
    }

    public function newEloquentBuilder($query): Builder
    {
        return new ProductBuilder(
            query: $query
        );
    }
    protected static function newFactory(): Factory
    {
        return ProductFactory::new();
    }

}
