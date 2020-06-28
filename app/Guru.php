<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'guru'; //custom table name
    protected $primaryKey = 'id'; //custom id column
    public $timestamps = false;

    protected $fillable = [
        'id', 'nip', 'nama_lengkap', 'no_hp', 'alamat', 'email', 'jenis_kelamin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];
}
