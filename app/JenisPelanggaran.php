<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class JenisPelanggaran extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'jenis_pelanggaran'; //custom table name
    protected $primaryKey = 'id'; //custom id column
    public $timestamps = false;

    protected $fillable = [
        'id', 'poin', 'tindakan', 'keterangan'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
