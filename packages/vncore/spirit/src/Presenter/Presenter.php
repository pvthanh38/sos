<?php

namespace VNCore\Spirit\Presenter;

use Illuminate\Database\Eloquent\Model;

abstract class Presenter
{
    protected $entity;

    public function __construct(Model $item)
    {
        $this->entity = $item;
    }

    public function __get($property)
    {
        if (method_exists($this, $property)) {
            return $this->{$property}();
        }

        return $this->entity->{$property};
    }

    /**
     * @return Model
     */
    public function getEntity() {
        return $this->entity;
    }
}