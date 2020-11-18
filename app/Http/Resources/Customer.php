<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Customer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      return
      [
       'id' => $this->id,
       'user_id' => $this->user_id,
       'total_booking' => $this->total_booking,
       'total_reviews' => $this->total_reviews,
       'total_reviews' => $this->total_reviews,
       'rating' => $this->rating,
       'state' => $this->state,
       'social_states' => $this->social_states,
       'date_of_birth' => $this->date_of_birth,
       'created_at' => $this->created_at,
       'updated_at' => $this->updated_at,


        ];
    }
}
