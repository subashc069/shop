<?php
declare(strict_types=1);

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => 'product',
            'attributes' => [
                'key' => $this->key,
                'name' => $this->name,
                'description' => $this->description,
                'price' => [
                    'cost' => $this->cost,
                    'retail' => $this->retail
                ],
                'active' => $this->active,
                'vat' => $this->vat,
            ],
            'relationships' => [
                'category' => new CategoryResource(
                    resource: $this->whenLoaded(
                        relationship: 'category',
                    )
                ),
                'range' => new RangeResource(
                    resource: $this->whenLoaded(
                        relationship: 'range',
                    )
                ),
                'variants' => VariantResource::collection(
                    resource: $this->whenLoaded(
                        relationship: 'variants'
                    )
                ),
            ],
            'links' => [
                '_self' => route(name: 'api:v1:products:show',parameters:  $this->key),
                '_parent' => route(name: 'api:v1:products:index')
            ]
        ];
    }
}
