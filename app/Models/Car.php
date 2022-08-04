<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

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

    public function models()
    {
        return $this->hasMany(Car::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(Car::class, 'parent_id');
    }
}
