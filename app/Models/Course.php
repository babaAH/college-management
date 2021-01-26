<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Course extends Model
{
    use AsSource;

    protected $fillable = [
        "session_of_the_started_to_teaching",
        "name"
    ];
}
