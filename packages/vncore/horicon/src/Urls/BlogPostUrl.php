<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class BlogPostUrl extends Url
{
    public function store()
    {
        return route('horicon.cms.blog.posts.store');
    }

    public function edit()
    {
        return route('horicon.cms.blog.posts.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.cms.blog.posts.update', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.cms.blog.posts.destroy', $this->entity);
    }
}