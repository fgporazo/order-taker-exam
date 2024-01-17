<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "product_id" => $this->id,
            "product_name" => $this->name,
            "product_sku" => $this->sku,
            "product_category_id" => $this->category->product_category_id,
            "product_category" => $this->category->name,
            "product_description" => $this->description,
        ];
    }

    
}
