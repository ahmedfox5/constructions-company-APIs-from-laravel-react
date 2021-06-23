<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'phone',
        'email',
        'message',
        'created_at',
        'updated_at',
    ];
}
