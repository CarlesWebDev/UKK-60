<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table = 'students';
    protected $guard = 'student';

    protected $fillable = [
        'name',
        'nisn',
        'grade',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function aspirations()
    {
        return $this->hasMany(Aspiration::class);
    }
}
