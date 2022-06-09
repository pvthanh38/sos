<?php

namespace VNCore\Horicon\Presenters;

use App\User;
use VNCore\Spirit\Presenter\Presenter;
use Illuminate\Support\HtmlString;

class UserPresenter extends Presenter
{
    /**
     * @param array $attributes
     *
     * @return string
     */
    public function avatar(array $attributes = [])
    {
        /** @var User $user */
        $user = $this->getEntity();
        $media = $user->getFirstMedia($user->imageField);
        if ($media) {
            return $media('thumb', $attributes);
        }

        $attributeString = collect($attributes)
            ->map(function ($value, $name) {
                return $name.'="'.$value.'"';
            })->implode(' ');

        if (strlen($attributeString)) {
            $attributeString = ' '.$attributeString;
        }

        return new HtmlString('<img src="' . asset('vendor/vncore/images/avatar.png') . '" ' . $attributeString . '/>');
    }

    /**
     * @return string
     */
    public function avatarPath()
    {
        /** @var User $user */
        $user = $this->getEntity();
        $media = $user->getImage();
        if ($media) {
            return $media->getFullUrl();
        }

        return NULL;
    }
}