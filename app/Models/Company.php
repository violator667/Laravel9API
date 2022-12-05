<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'nip',
        'address',
        'city',
        'post_code'
    ];

    protected $hidden = [
      'created_at',
      'updated_at'
    ];

    public function employees()
    {
        return $this->hasMany('App\Models\Employee');
    }
}
