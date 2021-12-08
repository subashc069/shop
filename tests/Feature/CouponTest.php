<?php

use Domains\Customer\Events\CouponWasApplied;
use Domains\Customer\Events\CouponWasRemovedFromCart;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\Coupon;
use JustSteveKing\StatusCode\Http;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use function Pest\Laravel\delete;
use function Pest\Laravel\post;

it('can apply coupons to the cart', function (Cart $cart, Coupon $coupon) {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);

    expect($cart)
        ->reduction
        ->toEqual(0);

    post(
        uri: route('api:v1:carts:coupons:store', [
            'cart' => $cart->uuid,
        ]),
        data: [
            'code' => $coupon->code
        ],
    )->assertStatus(Http::ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(CouponWasApplied::class);
})->with('cart', 'coupon');

it('can remove coupon from cart', function (Cart $cartWithCoupon) {
    expect($cartWithCoupon->coupon)->toBeString();

    delete(
        uri: route('api:v1:carts:coupons:delete', [
            'cart' => $cartWithCoupon->uuid,
            'uuid' => Coupon::query()->where('code', $cartWithCoupon->coupon)->first()->uuid,
        ]),
    )->assertStatus(Http::ACCEPTED);

    expect($cartWithCoupon->refresh()->coupon)->toBeNull();
})->with('cartWithCoupon');
