<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class StudentGroup extends Model
{
    use AsSource;

    protected $fillable = [
        'article',
        'department_id'
    ];

    public function students()
    {
        return $this->belongsToMany(\App\Models\User::class, 'user_studentgroup', 'studentgroup_id', 'user_id');
    }
}
