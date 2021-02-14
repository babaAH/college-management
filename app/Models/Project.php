<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use AsSource;

    protected $fillable = [
        "active", 
        "user_id",
        "course_id",
        "title",
        "description",
    ];

    protected $table = "projects";

    public function course()
    {
        return $this->belongsTo(\App\Models\Course::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
