<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    // Define relationships, if needed
    public function students()
    {
        return $this->hasMany(Student::class, 'class_teacher_id');
    }
}