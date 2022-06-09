<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class SosAskedQuestionUrl extends Url
{
    public function store()
    {
        return route('horicon.cms.sos.questions.store');
    }

    public function edit()
    {
        return route('horicon.cms.sos.questions.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.cms.sos.questions.update', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.cms.sos.questions.destroy', $this->entity);
    }
}