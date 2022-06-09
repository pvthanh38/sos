<?php
namespace VNCore\Horicon\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SosSupport extends JsonResource
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
            'user' => new User($this->user),
            'location' => $this->location,
            'position' => [$this->lat, $this->lng],
            'content' => $this->content,
            'closed' => $this->status,
            'urgent' => $this->urgent,
            'replay' => $this->replay,
            'replayed_at' => $this->replayed_at,
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}