<?php

namespace VNCore\Horicon\Auth;

use App\User;
use VNCore\Horicon\Models\Role;
use VNCore\Horicon\Models\SosUser;
use VNCore\Horicon\Models\UserLocation;
use VNCore\Horicon\Presenters\UserPresenter;
use VNCore\Horicon\Urls\UserUrl;
use VNCore\Spirit\Media\Imageable;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;

trait Userable
{
    use PresentableTrait;
    protected $presenter = UserPresenter::class;

    use UrlableTrait;
    protected $urler = UserUrl::class;

    use Imageable;
    public $imageField = 'avatar';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    /**
     * @return mixed
     */
    public function sosUser()
    {
        return $this->hasOne(SosUser::class);
    }

    /**
     * @return mixed
     */
    public function locations()
    {
        return $this->hasMany(UserLocation::class);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $direction
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrderUpdated($query, $direction = 'desc')
    {
        return $query->orderBy('updated_at', $direction);
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string                                $q
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $q)
    {
        return $query->where('name', 'like', '%' . $q . '%');
    }

    /**
     * @param string $role (admin, staff...)
     *
     * @return bool
     */
    public function hasRole($role)
    {
        $result = $this->hasRoleHoricon('admin');
        if ($result) {
            return TRUE;
        }

        return $this->hasRoleHoricon($role);
    }

    /**
     * @param string $role (admin, staff...)
     *
     * @return bool
     */
    private function hasRoleHoricon($role)
    {
        /** @var User $this */
        $total = $this->where('id', $this->id)
            ->whereHas('roles', function ($query) use ($role) {
                $query->where('name', $role);
            })->count();

        return boolval($total);
    }
}