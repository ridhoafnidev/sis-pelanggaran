<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Izin extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'izin'; //custom table name
    protected $primaryKey = 'id'; //custom id column
    public $timestamps = false; 

    protected $fillable = [
        'id', 'guru_id', 'kehadiran_id', 'nama_petugas', 'tahun_ajaran_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
