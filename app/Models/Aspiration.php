<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    //
    protected $table = 'aspirations';

    protected $fillable = [
        'student_id',
        'category_id',
        'feedback_id',
        'title',
        'description',
        'photo',
        'location',
        'status',
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function feedback() {
        return $this->belongsTo(Feedback::class);
    }
}
