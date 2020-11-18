<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkExperiences extends JsonResource
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
         'position_en' => $this->position_en,
         'position_ar' => $this->position_ar,
         'location_en' => $this->location_en,
         'location_ar' => $this->location_ar,
         'start_date' => $this->start_date,
         'end_date' => $this->end_date,
         'description_ar' => $this->description_ar,
         'currently' => $this->currently,
         'state' => $this->state,
         'description_en' => $this->description_en,
         'description_ar' => $this->description_ar,
         'created_at' => $this->created_at,
         'updated_at' => $this->updated_at
     ];
    }
}
