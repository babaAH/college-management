<?php

namespace App\Models;

use Orchid\Platform\Models\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    public function projects()
    {
        return $this->hasMany(\App\Models\Project::class);
    }

    public function courseScores()
    {
        return $this->belongsToMany(
            \App\Models\Project::class,
            "studentgroup_exam_scores",
            "student_id",
            "project_id"
        );
    }

    public function scopeIsTeacher($query)
    {
        // return $query->
        return ($query->whereHas('roles', function($query){
            return $query->where('slug', 'teacher');
        })->get());
    }

    public function scopeIsStudent($query)
    {
        // return $query->
        return ($query->whereHas('roles', function($query){
            return $query->where('slug', 'student');
        })->get());
    }
}
