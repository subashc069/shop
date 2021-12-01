<?php
declare(strict_types=1);

namespace Database\Factories;

use Domains\Customer\Models\Location;
use Domains\Customer\Status\Statuses\OrderStatus;
use Illuminate\Database\Eloquent\Factories\Factory;
use Domains\Customer\Models\Order;
use Domains\Customer\Models\User;
use Illuminate\Support\Arr;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $useCoupon = $this->faker->boolean();
        $state = Arr::random(OrderStatus::toLabels());
        return [
            'number' => $this->faker->bothify('ORD-####-####-####'),
            'state' => $state,
            'coupon' => $useCoupon ? $this->faker->imei() : null,
            'total' => $this->faker->numberBetween(10000, 100000),
            'reduction' => $useCoupon ? $this->faker->numberBetween(250, 2500) : 0,
            'user_id' => User::factory()->create(),
            'shipping_id' => Location::factory()->create(),
            'billing_id' => Location::factory()->create(),
            'completed_at' => $state == OrderStatus::completed() ? now() : null,
            'cancelled_at' => $state == OrderStatus::cancelled() ? now() : null,
        ];
    }
}
