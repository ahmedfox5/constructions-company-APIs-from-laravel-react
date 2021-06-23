<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'job',
        'img',
        'description',
    ];

    public function projects(){
        return $this -> belongsToMany('App\Project' ,'projects_employees' ,'employee_id');
    }
}
