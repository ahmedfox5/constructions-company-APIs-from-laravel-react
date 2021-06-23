<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'img',
        'description',
    ];

    public function sections (){
        return $this -> hasMany('\App\ProjectSection' ,'project_id');
    }

    public function images (){
        return $this -> hasMany('\App\ProjectImage' ,'project_id');
    }

    public function employees(){
        return $this->belongsToMany('\App\Employee' ,'projects_employees' ,'project_id' ,'employee_id');
    }
}
