<?php

namespace VNCore\Horicon\Urls;

use VNCore\Spirit\Url\Url;

class UserUrl extends Url
{
    public function profile()
    {
        return route('horicon.settings.profile');
    }

    public function account()
    {
        return route('horicon.settings.account');
    }

    public function notifications()
    {
        return route('horicon.notifications.index');
    }

    public function store()
    {
        return route('horicon.admin.users.store');
    }

    public function edit()
    {
        return route('horicon.admin.users.edit', $this->entity);
    }

    public function update()
    {
        return route('horicon.admin.users.update', $this->entity);
    }

    public function destroy()
    {
        return route('horicon.admin.users.destroy', $this->entity);
    }
}