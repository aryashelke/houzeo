<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films';

    const STATUS_ACTIVE = "A";
    const STATUS_DELETED = "D";
    const STATUS_INACTIVE = "I";

    protected $guarded = [];

    public function scopeActive($query){
    	return $query->where($this->table . '.status', self::STATUS_ACTIVE);
    }
}
