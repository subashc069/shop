<?php
// create a cart

use Domains\Catalog\Models\Variant;
use Domains\Customer\Events\ProductWasAddedToCart;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\User;
use Domains\Customer\Status\Statuses\CartStatus;
use JustSteveKing\StatusCode\Http;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use Illuminate\Testing\Fluent\AssertableJson;

it('creates a cart for an authenticated user', function () {
    post(
        uri: route('api:v1:carts:store')
    )->assertStatus(
        status: Http::CREATED
    )->assertJson(fn (AssertableJson $json) =>
        $json->where('type', 'cart')
            ->where('attributes.status', CartStatus::pending()->value)
            ->etc()
        );
});

it('returns a cart for a logged in user', function () {
    $cart = Cart::factory()->create();

    auth()->loginUsingId($cart->user_id);

    get(
        uri: route('api:v1:carts:index')
    )->assertStatus(Http::OK);
});

it('returns a not found status when a guest tries to retrive their carts', function () {
    get(
      uri: route('api:v1:carts:index')
    )->assertStatus(Http::NO_CONTENT);
});

it('can add a new product to a cart', function () {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);
    $cart = Cart::factory()->create();
    $variant = Variant::factory()->create();

   post(
       uri: route('api:v1:carts:products:store', $cart->uuid),
       data: [
           'quantity' => 1,
           'purchasable_id' => $variant->id,
           'purchasable_type' => 'variant',
       ],
   )->assertStatus(
       status: Http::CREATED
   );

   expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
   expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(ProductWasAddedToCart::class);
});
