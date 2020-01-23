<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Desa;
use App\User;
use App\Puskesmas;
use App\Pasien;
use App\Kohort;
use App\Kunjungan;

class SuperAdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isSuperAdmin');
    }

    public function showPasien()
    {        
        return view('superAdmin.showPasien');
    }

    public function getListPasien()
    {
        $pasien = Pasien::with('bidan.desa.puskesmas')->get();

        return response()->json([
            'error' => false,
            'pasien' => $pasien,
        ], 200);
    }

    public function showDetails($id)
    {
        $details = Kohort::with('pasien')->where('id_pasien',$id)->first();

        $kunjungans = Kunjungan::where('id_kohort', $details->id)
                    ->orderBy('tanggal_kunjungan', 'asc')
                    ->get();

        return response()->json([
            'error' => false,
            'details' => $details,
            'kunjungans' => $kunjungans
        ], 200);
    }

    public function showData()
    {
        $puskesmas = Puskesmas::all();
        return view('superAdmin.data', ['puskesmas' => $puskesmas]);
    }

    public function getAllData()
    {
        $data = DB::table('pasien')
                    ->join('users', 'users.id', '=', 'pasien.id_bidan')
                    ->select('pasien.kategori', DB::raw('count(pasien.kategori) as num'))
                    // ->where('users.id_puskesmas', Auth::user()->id_puskesmas)
                    ->groupBy('kategori')
                    ->orderBy('kategori', 'asc')
                    ->get();

        return response()->json($data);

    }

    public function showDataPuskesmas($id)
    {
        $data = DB::table('pasien')
                    ->join('users', 'users.id', '=', 'pasien.id_bidan')
                    ->select('pasien.kategori', DB::raw('count(pasien.kategori) as num'))
                    ->where('users.id_puskesmas', $id)
                    ->groupBy('kategori')
                    ->orderBy('kategori', 'asc')
                    ->get();

        return response()->json($data);

    }




}
