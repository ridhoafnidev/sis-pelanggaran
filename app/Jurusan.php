<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    //
    protected $table = 'jurusan';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id', 'jurusan'
    ];

    protected $hidden = [];
}
