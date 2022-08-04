<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use HasFactory;

    public function scopeFindByFieldOrId($query, $value, $field = null)
    {
        if(is_numeric($value)){
            $query->whereId($value);
        }

        if(!empty($field)){
            $fields = (array) $field;

            foreach ($fields as $field) {
                $query->orWhere($field, $value);
            }
        }

        return $query->first();
    }
}
