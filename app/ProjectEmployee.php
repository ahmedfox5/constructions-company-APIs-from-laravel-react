<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectEmployee extends Model
{
    protected $table = 'projects_employees';
    protected $fillable = [
      'project_id',
      'employee_id',
    ];
}
