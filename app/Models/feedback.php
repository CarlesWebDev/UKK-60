<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class feedback extends Model
{
    protected $table = 'feedback';

    protected $fillable = [
        'admin_id',
        'information',
    ];

    public function admin() {
        return $this->belongsTo(Admin::class);
    }

    public function aspirations() {
        return $this->hasOne(Aspiration::class);
    }
}
