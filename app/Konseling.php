<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Konseling extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'konseling'; //custom table name
    protected $primaryKey = 'id'; //custom id column
    public $timestamps = false; 

    protected $fillable = [
        'id', 'pelanggaran_detail_id', 'deskripsi_penanganan', 'hasil_konseling', 'rekomendasi', 'keterangan', 'konseler'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
