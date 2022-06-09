<?php

namespace VNCore\Horicon\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'social_id' => $this->sosUser->social_id,
            'birthday' => $this->sosUser->birthday,
            'departure_date' => $this->sosUser->departure_date,
            'gender' => $this->sosUser->gender,
            'phone' => $this->sosUser->phone,
            'avatar' => $this->present()->avatarPath(),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}