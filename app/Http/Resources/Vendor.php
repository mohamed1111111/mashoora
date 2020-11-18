<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\User as UserResource;

class Vendor extends JsonResource
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
         'user_id' => $this->user_id,
         'category_id' => $this->category_id,
         'profile_image' =>  asset('/images/vendors/'.$this->profile_image),
         'title_en' => $this->title_en,
         'title_ar' => $this->title_en,
         'bio_en' => $this->bio_en,
         'bio_ar' => $this->bio_ar,
         'description_en' => $this->description_en,
         'description_ar' => $this->description_ar,
         'address_en' => $this->address_en,
         'address_ar' => $this->address_ar,
         'area_id' => $this->area_id,
         'hour_price' => $this->hour_price,
         'state' => $this->state,
         'total_reviews' => $this->total_reviews,
         'rating' => $this->rating,
         'total_wallet' => $this->total_wallet,
         'id_front' => $this->id_front,
         'id_back' => $this->id_back,
         'certificate' => $this->certificate,
         'created_at' => $this->created_at,
         'updated_at' => $this->updated_at,
         'work_experiences' => WorkExperiences::collection($this->whenLoaded('work_experiences')),
         'working_hours' => WorkingHours::collection($this->whenLoaded('working_hours')),
         'rates' => Rate::collection($this->whenLoaded('rates')),
         'user' => new UserResource($this->whenLoaded('user')),

     ];
    }
}
