<?php

namespace VNCore\Horicon\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use VNCore\Horicon\Presenters\SosConversationPresenter;
use VNCore\Spirit\Media\Imageable;
use VNCore\Spirit\Presenter\PresentableTrait;

class SosConversationAdmin extends Model implements HasMedia
{
    use Imageable;
    public $imageField = 'media';

    use PresentableTrait;
    protected $presenter = SosConversationPresenter::class;

    protected $fillable = ['content'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function support()
    {
        return $this->belongsTo(SosSupport::class, 'support_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}
