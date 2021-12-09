<?php

namespace Domains\Customer\Projectors;

use Domains\Customer\Actions\CreateOrder;
use Domains\Customer\Events\OrderWasCreated;
use Domains\Customer\Factories\OrderFactory;
use Domains\Customer\Models\Order;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;

class OrderProjector extends Projector
{
    public function onOrderWasCreated(OrderWasCreated $event): void
    {
        $object = OrderFactory::make(
            attributes: [
                'cart' => $event->cart,
                'billing' => $event->billing,
                'shipping' => $event->shipping,
                'user' => $event->user,
                'email' => $event->email
            ]
        );

        CreateOrder::handle(
            object: $object,
        );
    }
}