<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kohort extends Model
{

    protected $table ='kohort';
    public $timestamps = false;

    protected $fillable = [
        'id_pasien','hamil', 'berat_badan', 'tinggi_badan','lingkar_lengan','haemoglobin',
        'sistole', 'diastole', 'jarak_kehamilan', 'riwayat_melahirkan', 'gagal_hamil', 'operasi_sesar'
    ];

    public function pasien()
    {
        return $this->belongsTo('App\Pasien', 'id_pasien');
    }
    
}
