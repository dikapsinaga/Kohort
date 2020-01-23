<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desa extends Model
{
    protected $table ='desa';

    public function puskesmas()
    {
        return $this->belongsTo('App\Puskesmas', 'id_puskesmas');
    }

}
