<?php

use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;

dataset('cart', [
    fn()=> Cart::factory()->create()
]);

dataset('3CartItems', [
    fn() => CartItem::factory()->create(['quantity' => 3])
]);

dataset('cartItem', [
    fn() => CartItem::factory()->create(['quantity' => 1])
]);

dataset('CartWith3Items',[
    fn() => Cart::factory()
        ->has(CartItem::factory(['quantity'=>2])->count(3),'items')
        ->create()
]);

dataset('cartWithCoupon', [
    fn() => Cart::factory()->withCoupon()->create()
]);
