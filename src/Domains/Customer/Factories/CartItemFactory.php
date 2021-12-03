<?php

namespace Domains\Customer\Factories;

use Domains\Customer\ValueObjects\CartItemValueObject;

class CartItemFactory
{
    public static function make(array $attributes): CartItemValueObject
    {
        return new CartItemValueObject(
           quantity:  $attributes['quantity'],
            purchasableID: $attributes['purchasable_id'],
            purchasableType: $attributes['purchasable_type']
        );
    }
}
