<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $guard = 'students';

    protected $table = 'students';

    protected $fillable = [
        'nisn',
        'name',
        'grade',
        'password'
    ];

    protected $hidden = [
        'remember_token',
        'password'
    ];

    public function Aspiration()
    {
        return $this->hasMany(Student::class);
    }



    //
}
