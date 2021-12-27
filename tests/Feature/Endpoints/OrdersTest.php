<?php

declare(strict_types=1);

use Domains\Customer\Events\OrderWasCreated;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\Location;
use JustSteveKing\StatusCode\Http;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use function Pest\Laravel\post;

it('can create an order form the cart using the API', function () {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);

    $item = CartItem::factory()->create();
    $location = Location::factory()->create()->id;
    post(
        uri: route('api:v1:orders:store'),
        data: [
            'cart' => $item->cart->uuid,
            'email' => 'bcoolboy8@gmail.com',
            'shipping' => $location,
            'billing' => $location,
        ],
    )->assertStatus(Http::ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(OrderWasCreated::class);
});
