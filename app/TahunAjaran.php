<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TahunAjaran extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'tahun_ajaran'; //custom table name
    protected $primaryKey = 'id'; //custom id column
    public $timestamps = false; 

    protected $fillable = [
        'id', 'tahun_awal', 'tahun_akhir', 'tahun_ajaran'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
