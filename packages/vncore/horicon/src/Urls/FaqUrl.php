<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class FaqUrl extends Url
{
    public function store()
    {
        return route('horicon.cms.faqs.store');
    }

    public function show()
    {
        return route('horicon.cms.faqs.show', $this->entity);
    }

    public function edit()
    {
        return route('horicon.cms.faqs.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.cms.faqs.update', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.cms.faqs.destroy', $this->entity);
    }

    public function storeComment()
    {
        return route('horicon.cms.faqs.store.comment', $this->entity);
    }
}