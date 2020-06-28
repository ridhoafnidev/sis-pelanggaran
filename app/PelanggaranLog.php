<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class PelanggaranLog extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'pelanggaran_log'; //custom table name
    protected $primaryKey = 'id'; //custom id column
    public $timestamps = false;

    protected $fillable = [
        'id', 'pelanggaran_detail_id', 'jenis_pelanggaran_id','tahun_ajaran_id','ajukan', 'kehadiran_id', 'nama_petugas'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
