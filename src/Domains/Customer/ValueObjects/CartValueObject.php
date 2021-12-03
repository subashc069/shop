<?php

namespace Domains\Customer\ValueObjects;

/**
 * @template TKey
 * @template TValue
 */
class CartValueObject
{
    public function __construct(
        public string $status,
        public null|int $userId,
    ) {}

    /**
     * @return array<Tkey,Tvalue>
     */
    public function toArray(): array
    {
        return [
            'status' => $this->status,
            'user_id' => $this->userId,
        ];
    }
}
