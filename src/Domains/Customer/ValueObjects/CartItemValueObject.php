<?php

namespace Domains\Customer\ValueObjects;

/**
 * @template CartItemValueObject
 * @template TValue
 */
class CartItemValueObject
{
    /**
     * @param int $quantity
     * @param int $purchasableID
     * @param string $purchasableType
     */
    public function __construct(
        public int $quantity,
        public int $purchasableID,
        public string $purchasableType
    ){}

    /**
     * @return array<string, TValue>
     */
    public function toArray(): array
    {
        return [
            'quantity' => $this->quantity,
            'purchasable_id' => $this->purchasableID,
            'purchasable_type' => $this->purchasableType,
        ];
    }
}
