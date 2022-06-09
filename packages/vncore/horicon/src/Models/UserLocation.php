<?php

namespace VNCore\Horicon\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    protected $fillable = ['location', 'lat', 'lng', 'country', 'city'];
}
