<?php

namespace VNCore\Spirit\Url;

trait UrlableTrait
{
    /**
     * View presenter instance
     *
     * @var mixed
     */
    protected $urlInstance;

    /**
     * Prepare a new or cached presenter instance
     *
     * @return mixed
     * @throws \Exception
     */
    public function url()
    {
        if (!$this->urler or !class_exists($this->urler)) {
            throw new \Exception('Please set the $presenter property to your presenter path.');
        }
        if (!$this->urlInstance) {
            $this->urlInstance = new $this->urler($this);
        }
        return $this->urlInstance;
    }
}