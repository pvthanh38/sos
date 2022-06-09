<?php

namespace VNCore\Horicon\Models;

use Illuminate\Database\Eloquent\Model;

class SosContractLocation extends Model
{
    protected $fillable = ['lat', 'lng'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contract()
    {
        return $this->belongsTo(SosContract::class, 'contract_id');
    }
}
