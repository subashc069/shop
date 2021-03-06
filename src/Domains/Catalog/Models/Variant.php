<?php
declare(strict_types=1);

namespace Domains\Catalog\Models;

use Database\Factories\VariantFactory;
use Domains\Catalog\Models\Builders\VariantBuilder;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\OrderLine;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use JustSteveKing\KeyFactory\Models\Concerns\HasKey;

class Variant extends Model
{
    use HasFactory;
    use HasKey;

    protected $fillable = [
        'name',
        'cost',
        'retail',
        'height',
        'width',
        'length',
        'weight',
        'active',
        'shippable',
        'product_id'
    ];

    protected $casts = [
        'active' => 'boolean',
        'shippable' => 'boolean'
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(
            Product::class,
            'product_id'
        );
    }

    public function purchases(): MorphMany
    {
        return  $this->morphMany(
            related: CartItem::class,
            name: 'purchasable'
        );
    }

    public function orders(): MorphMany
    {
        return $this->morphMany(
            related: OrderLine::class,
            name: 'purchasable',
        );
    }
    public function newEloquentBuilder($query): Builder
    {
        return new VariantBuilder(
            $query
        );
    }

    protected static function newFactory(): Factory
    {
        return VariantFactory::new();
    }
}
