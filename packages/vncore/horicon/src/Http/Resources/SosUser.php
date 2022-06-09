<?php
namespace VNCore\Horicon\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SosUser extends JsonResource
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
            'social_id' => $this->social_id,
            'birthday' => $this->birthday,
            'name' => $this->name,
            'gender' => $this->gender,
            'phone' => $this->phone,
            'avatar' => $this->user->present()->avatarPath(),
        ];
    }
}