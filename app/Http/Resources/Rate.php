<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Rate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
     return [
      'id' => $this->id,
      'vendor_id' => $this->vendor_id,
      'customer_id' => $this->customer_id,
      'enrollment_id' => $this->enrollment_id,
      'stars' => $this->stars,
      'comment' => $this->comment,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at
       ];
    }
}
