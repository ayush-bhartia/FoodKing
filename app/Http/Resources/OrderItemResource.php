<?php

namespace App\Http\Resources;


use App\Libraries\AppLibrary;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {


        return [
            'id'                            => $this->id,
            'order_id'                      => $this->order_id,
            'branch_id'                     => $this->branch_id,
            'item_id'                       => $this->orderItem?->id,
            'item_name'                     => $this->orderItem?->name,
            'item_image'                    => $this->orderItem?->thumb,
            'quantity'                      => $this->quantity,
            'discount'                      => AppLibrary::currencyAmountFormat($this->discount),
            'price'                         => AppLibrary::currencyAmountFormat($this->price),
            'item_variations'               => json_decode($this->item_variations),
            'item_extras'                   => json_decode($this->item_extras),
            'item_variation_currency_total' => AppLibrary::currencyAmountFormat($this->item_variation_total),
            'item_extra_currency_total'     => AppLibrary::currencyAmountFormat($this->item_extra_total),
            'total_convert_price'           => AppLibrary::convertAmountFormat($this->total_price),
            'total_currency_price'          => AppLibrary::currencyAmountFormat($this->total_price),
            'instruction'                   => $this->instruction,
        ];
    }
}
