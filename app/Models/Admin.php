<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admins';
    protected $table = 'admins';

    protected $fillable = [
        'email',
        'name',
        'password',
    ];

    protected $hidden = [
        'remember_token',
        'password'
    ];

    public function Feedback()
    {
        return $this->hasMany(Feedback::class);
    }
    //
}
