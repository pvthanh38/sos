<?php

namespace VNCore\Horicon\Presenters;

use Illuminate\Support\HtmlString;
use VNCore\Horicon\Models\BlogPost;
use VNCore\Spirit\Presenter\Presenter;

class BlogPostPresenter extends Presenter
{
    /**
     * @param array $attributes
     *
     * @return string
     */
    public function image(array $attributes = [])
    {
        /** @var BlogPost $post */
        $post = $this->getEntity();
        $media = $post->getImage();
        if ($media) {
            return $media('thumb', $attributes);
        }

        $ats = join(' ', array_map(function ($key) use ($attributes) {
            return $key . '="' . $attributes[$key] . '"';
        }, array_keys($attributes)));

        return new HtmlString('<img src="' . asset('vendor/vncore/images/default.jpg') . '" ' . $ats . '/>');
    }
}