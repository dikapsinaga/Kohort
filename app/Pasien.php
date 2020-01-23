<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table ='pasien';
    public $timestamps = false;


    protected $fillable = [
        'id_bidan','nama_istri', 'nama_suami', 'alamat','nomor_hp','umur', 'kategori'
    ];

    // public function kohort()
    // {
    //     return $this->hasOne('App\Kohort', 'id_pasien');
    // }

    public function bidan()
    {
        return $this->belongsTo('App\User', 'id_bidan');
    }

    
}
