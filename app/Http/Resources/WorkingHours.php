<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkingHours extends JsonResource
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
         'day' => $this->day,
         'from' => $this->from,
         'to' => $this->to,
         'state' => $this->state,
         'created_at' => $this->created_at,
         'updated_at' => $this->updated_at
      ];
    }
}
