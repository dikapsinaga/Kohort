<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    protected $table ='kunjungan';
    public $timestamps = false;

    protected $fillable = [
        'tanggal_kunjungan', 'tempat_pelayanan', 'kode_pelayanan','penyakit'
    ];

    public function kohort()
    {
        return $this->belongsTo('App\Kohort', 'id_kohort');
    }
}
