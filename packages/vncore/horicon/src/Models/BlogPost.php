<?php

namespace VNCore\Horicon\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use VNCore\Horicon\Presenters\BlogPostPresenter;
use VNCore\Horicon\Urls\BlogPostUrl;
use VNCore\Spirit\Media\Imageable;
use VNCore\Spirit\Presenter\PresentableTrait;
use VNCore\Spirit\Url\UrlableTrait;

class BlogPost extends Model implements HasMedia
{
    use PresentableTrait;
    protected $presenter = BlogPostPresenter::class;

    use UrlableTrait;
    protected $urler = BlogPostUrl::class;

    use Imageable;
    public $imageField = 'image';

    protected $fillable = ['title', 'slug', 'content', 'summary', 'status', 'meta_description', 'layout', 'category_id'];

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

    public function isActive()
    {
        return $this->status == TRUE;
    }
}
