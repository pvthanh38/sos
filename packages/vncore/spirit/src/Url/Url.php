<?php

namespace VNCore\Spirit\Url;

use Illuminate\Database\Eloquent\Model;

abstract class Url
{
    protected $entity;

    public function __construct(Model $entity)
    {
        $this->entity = $entity;
    }

    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        return $this->entity->{$property};
    }
}