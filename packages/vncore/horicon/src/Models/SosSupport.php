<?php

namespace VNCore\Horicon\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use VNCore\Horicon\Presenters\SosSupportPresenter;
use VNCore\Horicon\Urls\SosSupportUrl;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;

class SosSupport extends Model
{
    use PresentableTrait;
    protected $presenter = SosSupportPresenter::class;

    use UrlableTrait;
    protected $urler = SosSupportUrl::class;

    protected $fillable = ['title', 'content', 'location', 'lat', 'lng', 'status', 'urgent', 'replay', 'phone'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversations()
    {
        return $this->hasMany(SosConversation::class, 'support_id')->orderBy('created_at', 'desc');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function conversationsAdmin()
    {
        return $this->hasMany(SosConversationAdmin::class, 'support_id')->orderBy('created_at', 'desc');
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
        return $query->where('content', 'like', $value)->orWhere('title', 'like', $value);
    }
}
