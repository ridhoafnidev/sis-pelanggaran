<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class NotifPelanggaran extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'notif_pelanggaran'; //custom table name
    protected $primaryKey = 'id'; //custom id column
    public $timestamps = false;

    protected $fillable = [
        'id', 'nis', 'total_poin', 'tahun_ajaran_id', 'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
