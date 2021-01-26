<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

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
