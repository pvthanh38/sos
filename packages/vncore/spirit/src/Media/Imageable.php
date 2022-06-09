<?php

namespace VNCore\Spirit\Media;

use Illuminate\Support\Collection;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

trait Imageable
{
    use HasMediaTrait;

    //protected $imageField = NULL;

    public function registerMediaCollections()
    {
        $this->addMediaCollection($this->imageField)->singleFile();
    }

    public function registerMediaConversions(Media $media = NULL)
    {
        $this->addMediaConversion('thumb')
            ->optimize()
            ->withResponsiveImages()
            ->performOnCollections($this->imageField);
    }

    public function addImageFromRequest()
    {
        $field = $this->imageField;
        if (request()->hasFile($field)) {
            $this->addMediaFromRequest($field)->toMediaCollection($field);
        }
    }

    public function getImage() {
        $field = $this->imageField;
        return $this->getFirstMedia($field);
    }
}