<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Siswa extends Authenticatable
{
    use Notifiable;
    protected $guarded = []; //TAMBAHKAN LINE INI
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'siswa'; //custom table name
    protected $primaryKey = 'nis'; //custom id column
    public $timestamps = false;

    protected $fillable = [
        'nama_lengkap', 'nis', 'alamat', 'jenis_kelamin', 'rombel', 'jurusan',  'tempat_lahir', 'tanggal_lahir', 'ortu_wali', 'foto'
    ];

    protected $casts = [
        'nis' => 'string',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
