<?php

namespace App\Models;

use App\Models\State;

class Customer extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
