<?php

namespace Domains\Customer\ValueObjects;

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
    ) {}

    /**
     * @return array<Tkey,Tvalue>
     */
//    public function toArray(): array
//    {
//        return [
//            'status' => $this->status,
//            'user_id' => $this->userId,
//        ];
//    }
}