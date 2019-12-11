<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * Mass assignable fields
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'description'
    ];
}
