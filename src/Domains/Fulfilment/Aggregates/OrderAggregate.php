<?php

namespace Domains\Fulfilment\Aggregates;

use Domains\Fulfilment\Events\OrderWasCreated;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class OrderAggregate extends AggregateRoot
{
    public function orderCreate(string $cart, int $shipping, int $billing, null|int $user, null|string $email): self
    {
        $this->recordThat(
            domainEvent: new OrderWasCreated(
                cart: $cart,
                shipping: $shipping,
                billing: $billing,
                user: $user,
                email: $email
            )
        );
        return $this;
    }
}
