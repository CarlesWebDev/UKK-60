<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'admin_id',
        'information',
    ];

    public function Admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function Aspiration()
    {
        return $this->hasOne(Aspiration::class);
    }

    //
}
