<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class IzinGerbang extends Model
{
    //
    use Notifiable;
    //
    protected $table='izin_gerbang';
    protected $primaryKey='id';
    public $timestamps=false;
    protected $fillable =[
        'izin_detail_id','masuk','keluar','tidak_masuk'
    ];
}
