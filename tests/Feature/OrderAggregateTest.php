<?php

use Domains\Customer\Aggregates\OrderAggregate;
use Domains\Customer\Events\OrderWasCreated;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\Location;
use Domains\Customer\Models\User;

it('can create an order for unauthenticated user', function (CartItem $cartItem, Location $location) {
   OrderAggregate::fake()
    ->given(
        events: new OrderWasCreated(
            cart: $cartItem->cart->uuid,
            shipping: $location->id,
            billing: $location->id,
            user: null,
            email: 'bcoolboy8@gmail.com',
        ),
    )->when(
        callable: function (OrderAggregate $aggregate) use ($cartItem, $location) {
            $aggregate->orderCreate(
                cart: $cartItem->cart->uuid,
                shipping: $location->id,
                billing: $location->id,
                user: null,
                email: 'bcoolboy8@gmail.com',
            );
           },
       )->assertEventRecorded(
           expectedEvent: new OrderWasCreated(
               cart: $cartItem->cart->uuid,
               shipping: $location->id,
               billing: $location->id,
               user: null,
               email: 'bcoolboy8@gmail.com',
           ),
       );
})->with('3CartItems', 'location');

it('can create an order for authenticated user', function (CartItem $cartItem, Location $location) {
    auth()->login(User::factory()->create());
    OrderAggregate::fake()
        ->given(
            events: new OrderWasCreated(
                cart: $cartItem->cart->uuid,
                shipping: $location->id,
                billing: $location->id,
                user: auth()->id(),
                email: null,
            ),
        )->when(
            callable: function (OrderAggregate $aggregate) use ($cartItem, $location) {
                $aggregate->orderCreate(
                    cart: $cartItem->cart->uuid,
                    shipping: $location->id,
                    billing: $location->id,
                    user: auth()->id(),
                    email: null,
                );
            },
        )->assertEventRecorded(
            expectedEvent: new OrderWasCreated(
                cart: $cartItem->cart->uuid,
                shipping: $location->id,
                billing: $location->id,
                user: auth()->id(),
                email: null,
            ),
        );
})->with('3CartItems', 'location');
