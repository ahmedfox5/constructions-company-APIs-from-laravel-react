<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectSection extends Model
{
    protected $table = 'project_sections';
    protected $fillable = [
      'description',
      'img',
      'project_id',
    ];
    public function project(){
        return $this -> belongsTo('App\Projects');
    }
}
