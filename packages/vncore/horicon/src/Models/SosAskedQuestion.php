<?php

namespace VNCore\Horicon\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use VNCore\Horicon\Presenters\SosAskedQuestionPresenter;
use VNCore\Horicon\Urls\SosAskedQuestionUrl;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;

class SosAskedQuestion extends Model
{
    use PresentableTrait;
    protected $presenter = SosAskedQuestionPresenter::class;

    use UrlableTrait;
    protected $urler = SosAskedQuestionUrl::class;

    protected $fillable = ['title', 'content'];

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
