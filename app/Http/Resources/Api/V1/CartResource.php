<?php
declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->uuid,
            'type' => 'cart',
            'attributes' => [
                'id' => $this->uuid,
                'status' => $this->status,
                'coupon' => $this->coupon,
                'reduction' => $this->reduction,
                'total' => $this->total,
                'user_id' => $this->user_id,
            ],
            'relationships' => [
                'items' => CartItemResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'items',
                    )
                )
            ]
        ];
    }
}
