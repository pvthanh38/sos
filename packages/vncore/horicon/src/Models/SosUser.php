<?php

namespace VNCore\Horicon\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class SosUser extends Model
{
    protected $fillable = ['name', 'social_id', 'birthday', 'departure_date', 'gender', 'phone', 'security_answer'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract()
    {
        return $this->belongsTo(SosContract::class, 'contract_id')->withDefault(['code' => 'None']);
    }

    /**
     * @return mixed
     */
    public function locations()
    {
        return $this->hasMany(UserLocation::class, 'user_id', 'user_id');
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
        $value = '%' . $q . '%';
        return $query->where('name', 'like', $value)
            ->orWhere('social_id', 'like', $value)
            ->orWhere('phone', 'like', $value);
    }
}
