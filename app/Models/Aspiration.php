<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspiration extends Model
{
    protected $table = 'aspirations';

    protected $fillable = [
        'student_id',
        'category_id',
        'feedback_id',
        'title',
        'description',
        'location',
        'photo',
        'status',
    ];

    public function Student()
    {
        return $this->belongsTo(Student::class);
    }
    public function Category()
    {
        return $this->belongsTo(Category::class);
    }
    public function Feedback()
    {
        return $this->belongsTo(Feedback::class);
    }
}
