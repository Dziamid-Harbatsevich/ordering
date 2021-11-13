<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'client_name' => $this->client_name,
            'total' => $this->total,
            'delivery_address' => $this->delivery_address,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
