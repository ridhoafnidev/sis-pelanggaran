<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class IzinDetail extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'izin_detail'; //custom table name
    protected $primaryKey = 'id'; //custom id column
    public $timestamps = false;

    protected $fillable = [
        'id', 'izin_id', 'keterangan_izin', 'nis'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
