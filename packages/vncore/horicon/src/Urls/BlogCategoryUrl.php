<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class BlogCategoryUrl extends Url
{
    public function store()
    {
        return route('horicon.cms.blog.categories.store');
    }

    public function edit()
    {
        return route('horicon.cms.blog.categories.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.cms.blog.categories.update', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.cms.blog.categories.destroy', $this->entity);
    }
}