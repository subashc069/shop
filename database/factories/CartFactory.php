<?php
declare(strict_types=1);

namespace Database\Factories;

use Domains\Customer\Models\Cart;
use Domains\Customer\Status\Statuses\CartStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Domains\Customer\Models\User;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        $useCoupon = $this->faker->boolean();

        return [
            'status' => Arr::random(
                array: CartStatus::toLabels()
            ),
            'coupon' => $useCoupon ?  $this->faker->imei() : null,
            'total' => $this->faker->numberBetween(1000, 100000),
            'reduction' => $useCoupon ? $this->faker->numberBetween(250, 2500) : 0,
            'user_id' => User::factory()->create(),
        ];
    }
}
