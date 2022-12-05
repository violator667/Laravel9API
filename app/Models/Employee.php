<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'company_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
