<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Kehadiran extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'kehadiran'; //custom table name
    protected $primaryKey = 'kode_kehadiran'; //custom id column
    public $timestamps = false; 

    protected $fillable = [
        'kode_kehadiran', 'jenis_kehadiran'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
