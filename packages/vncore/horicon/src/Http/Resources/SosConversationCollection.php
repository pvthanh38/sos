<?php
namespace VNCore\Horicon\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SosConversationCollection extends ResourceCollection
{
    public $collects = SosConversation::class;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}