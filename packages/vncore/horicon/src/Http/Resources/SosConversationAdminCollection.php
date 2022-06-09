<?php
namespace VNCore\Horicon\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SosConversationAdminCollection extends ResourceCollection
{
    public $collects = SosConversationAdmin::class;

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
