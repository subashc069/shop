<?php

namespace Domains\Fulfilment\ValueObjects;

class OrderValueObject
{
    /**
     * @param string $cart
     * @param int $shipping
     * @param int $billing
     * @param int|null $user
     * @param string|null $email
     */
    public function __construct(
        public string $cart,
        public int $shipping,
        public int $billing,
        public null|int $user,
        public null|string $email,
        public null|string $intent,
    ) {}

}
