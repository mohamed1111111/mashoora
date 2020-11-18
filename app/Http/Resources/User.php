<?php

namespace App\Http\Resources;
use App\Http\Resources\Vendor as VendorResource;
use App\Http\Resources\Customer as CustomerResource;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
         'name' => $this->name,
         'email' => $this->email,
         'country_code' => $this->country_code,
         'phone_number' => $this->phone_number,
         'type' => $this->type,
         'gender' => $this->gender,
         'device_token' => $this->device_token,
         'apple_token' => $this->apple_token,
         'google_token' => $this->google_token,
         'snapchat_token' => $this->snapchat_token,
         'is_verfied' => $this->is_verfied,
         'language' => $this->language,
         'state' => $this->state,
         'created_at' => $this->created_at,
         'updated_at' => $this->updated_at,
         'vendor' => new  VendorResource($this->whenLoaded('vendor')),
         'customer' => new  CustomerResource($this->whenLoaded('customer')),


          ];
    }
}
