<?php

use Domains\Customer\Events\OrderWasCreated;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\Location;
use Domains\Customer\Models\User;
use JustSteveKing\StatusCode\Http;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use function Pest\Laravel\post;

it('can convert a cart to an order for an unauthenticated user', function (CartItem $cartItem) {
    expect(EloquentStoredEvent::query()->get())->toBeEmpty();

    $location = Location::factory()->create();
    post(
        uri: route('api:v1:orders:store'),
        data: [
            'cart' => $cartItem->cart->uuid,
            'email' => 'test@pest.com',
            'shipping' => $location->id,
            'billing' => $location->id,
        ]
    )->assertStatus(Http::ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(OrderWasCreated::class);
})->with('3CartItems');

it('can convert a cart to an order for an authenticated user', function (CartItem $cartItem) {

    auth()->login(User::factory()->create());
    expect(EloquentStoredEvent::query()->get())->toBeEmpty();
    $location = Location::factory()->create();

    post(
        uri: route('api:v1:orders:store'),
        data: [
            'cart' => $cartItem->cart->uuid,
            'shipping' => $location->id,
            'billing' => $location->id,
        ]
    )->assertStatus(Http::ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(OrderWasCreated::class);

})->with('3CartItems');
