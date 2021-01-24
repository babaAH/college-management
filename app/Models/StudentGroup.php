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
}
