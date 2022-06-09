<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class SosSupportUrl extends Url
{
    public function store()
    {
        return route('horicon.cms.sos.supports.store');
    }

    public function show()
    {
        return route('horicon.cms.sos.supports.show', $this->entity);
    }

    public function show2()
    {
        return route('horicon.cms.sos.supports.show2', $this->entity);
    }

    public function edit()
    {
        return route('horicon.cms.sos.supports.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.cms.sos.supports.update', $this->entity);
    }

    public function close()
    {
        return route('horicon.cms.sos.supports.close', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.cms.sos.supports.destroy', $this->entity);
    }

    public function storeComment()
    {
        return route('horicon.cms.sos.supports.store.comment', $this->entity);
    }

    public function storeAdminComment()
    {
        return route('horicon.cms.sos.supports.store.adminComment', $this->entity);
    }
}
