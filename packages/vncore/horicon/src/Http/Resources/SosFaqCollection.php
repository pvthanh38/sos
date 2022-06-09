<?php
namespace VNCore\Horicon\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SosFaqCollection extends ResourceCollection
{
    public $collects = SosFaq::class;

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