<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'andress'
    ];

    public function sales()
    {
        return $this->hasMany('App\Models\Sale');
    }

    public function user()
    {
        return $this->hasOne('App\User');
    }


}
