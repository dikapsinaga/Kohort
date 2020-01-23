<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Desa;
use App\Pasien;
use App\Kohort;
use App\Kunjungan;



use Illuminate\Support\Facades\Auth;



class BidanController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }


    public function showPasien(Request $request)
    {
        
        $request->session()->forget(['pasien', 'kohort']);
        $pasien = Pasien::where('id_bidan', Auth::user()->id)->get();

        return view('bidan.showPasien', ['pasien'=> $pasien]);
    }


    public function getListPasien()
    {
        $pasien = Pasien::where('id_bidan', Auth::user()->id)->get();
        
        return response()->json([
            'error' => false,
            'pasien' => $pasien,
        ], 200);

    }

    
    public function setPasienSession(Request $request, $id)
    {
        $data_pasien = Pasien::find($id);
        $data_kohort = Kohort::where('id_pasien', $data_pasien->id)->first();
        
        // dd($data_pasien);
        $pasien = new Pasien();
        $pasien->id = $data_pasien->id;
        $pasien->fill($data_pasien->toArray());
        
        $kohort = new Kohort();
        $kohort->id = $data_kohort->id;
        $kohort->fill($data_kohort->toArray());
        
        $request->session()->put('pasien', $pasien);
        $request->session()->put('kohort', $kohort);
        
        return response()->json([
            'error' => false,
        ], 200);
    }

    public function showDeletePasienForm($id)
    {
        $pasien = Pasien::find($id);

        return response()->json([
            'error' => false,
            'pasien' => $pasien,
        ], 200);
    }

    public function deletePasien($id)
    {
        $pasien = Pasien::destroy($id);

        return response()->json([
            'error' => false,
            'pasien' => $id,
        ], 200);
    }

    

    
    public function showPasienForm(Request $request)
    {

        $pasien = $request->session()->get('pasien');
        return view('bidan.addPasien', compact('pasien', $pasien));
    }

    public function createPasien(Request $request)
    {

        // echo Carbon::parse($request->input('tanggal_lahir'))->age;
        $validator = Validator::make($request->all(), [
            'nama_istri' => 'required|string',
            'nama_suami' => 'required|string',
            'alamat' => 'required|string',
            'nomor_hp' => 'required|numeric|digits_between:9,13',
            'umur' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('/pasien/PasienForm')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $validator->validate();

        if(empty($request->session()->get('pasien'))){
            $pasien = new Pasien();
            $pasien->fill($data);
            $request->session()->put('pasien', $pasien);
        }else{
            $pasien = $request->session()->get('pasien');
            $pasien->fill($data);
            $request->session()->put('pasien', $pasien);
        }

        return redirect('/pasien/KohortForm');
    }

    public function showKohortForm(Request $request)
    {
        $kohort = $request->session()->get('kohort');

        // dd($request->session()->get('pasien'));
        return view('bidan.addKohort', compact('kohort', $kohort));
    }

    public function createKohort(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'hamil' => 'required|numeric',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'lingkar_lengan' => 'required|numeric',
            'haemoglobin' => 'required|numeric',
            'sistole' => 'required|numeric',
            'diastole' => 'required|numeric',
            'jarak_kehamilan' => 'numeric',
            'riwayat_melahirkan' => '',
            'gagal_hamil' => 'required|boolean',
            'operasi_sesar' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect('/pasien/KohortForm')
                        ->withErrors($validator)
                        ->withInput();
        }

        $data = $validator->validate();

        if(empty($request->session()->get('kohort'))){
            $kohort = new Kohort();
            $kohort->fill($data);
            $request->session()->put('kohort', $kohort);
        }else{
            $kohort = $request->session()->get('kohort');
            $kohort->fill($data);
            $request->session()->put('kohort', $kohort);
            // dd($kohort);
        }

        
        $this->store($request);

        return redirect(url('/pasien/KunjunganForm'));
        // return redirect('/pasien/KunjunganForm');
    }

    public function store(Request $request)
    {
        $pasien = $request->session()->get('pasien');
        $kohort = $request->session()->get('kohort');


        $newPasien = Pasien::updateOrCreate(
            [
                'id' => $pasien->id,
            ],
            
            [
                'id_bidan' => Auth::user()->id,
                'nama_istri' => $pasien->nama_istri,
                'nama_suami' => $pasien->nama_suami,
                'alamat' => $pasien->alamat,
                'nomor_hp' => $pasien->nomor_hp,
                'umur' => $pasien->umur,            
            ]
        );

        $kohort->id_pasien = $newPasien->id;

        $newKohort = Kohort::updateOrCreate(
            [
                'id' => $kohort->id
            ],
            [
                "id_pasien" => $newPasien->id,
                "hamil" => $kohort->hamil,
                "berat_badan" => $kohort->berat_badan,
                "tinggi_badan" => $kohort->tinggi_badan,
                "lingkar_lengan" => $kohort->lingkar_lengan,
                "haemoglobin" => $kohort->haemoglobin,
                "sistole" => $kohort->sistole,
                "diastole" => $kohort->diastole,
                "jarak_kehamilan" => $kohort->jarak_kehamilan,
                "riwayat_melahirkan" => $kohort->riwayat_melahirkan,
                "gagal_hamil" => $kohort->gagal_hamil,
                "operasi_sesar" => $kohort->operasi_sesar,
            ]
        );

    $request->session()->forget(['pasien', 'kohort']);

    $request->session()->put('pasien', $newPasien);
    $request->session()->put('kohort', $newKohort);

    }

    
    public function showKunjunganForm(Request $request)
    {
        $kohort = $request->session()->get('kohort');
        // dd($kohort->id);
        $kunjungan = Kunjungan::where('id_kohort', $kohort->id)
                    ->orderBy('tanggal_kunjungan', 'asc')
                    ->get();

        $this->setKategori($kohort->id);
        
        // $kunjungan = $request->session()->get('kunjungan');
        // dd($request->session()->get('kohort'));
        return view('bidan.showKunjungan', ['kunjungans'=> $kunjungan]);
    }


    public function showAddKunjunganForm()
    {
        return response()->json([
            'error' => false,
        ], 200);
    }


    public function createKunjungan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_kunjungan' => 'required|date',
            'tempat_pelayanan' => 'required|string',
            'kode_pelayanan' => 'required|string',
            'penyakit' => ''
        ]);


        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validate();
        

        $kunjungan = new Kunjungan();
        $kunjungan->fill($data);

        $kunjungan->id_kohort = $request->session()->get('kohort')->id;
        $kunjungan->tanggal_kunjungan = Carbon::parse($request->tanggal_kunjungan);
        $kunjungan->save();


        return response()->json([
            'error' => false,
            'kunjungan'  => $kunjungan,
        ], 200);

        // return redirect('/pasien/KunjunganForm');
    }

    public function showEditKunjunganForm($id)
    {
        $kunjungan = Kunjungan::find($id);

        return response()->json([
            'error' => false,
            'kunjungan' => $kunjungan,
        ], 200);
    }


    public function updateKunjungan(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'tanggal_kunjungan' => 'required|date',
            'tempat_pelayanan' => 'required|string',
            'kode_pelayanan' => 'required|string',
            'penyakit' => ''
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $data = $validator->validate();

        $kunjungan = Kunjungan::find($id);
        $kunjungan->fill($data);

        $kunjungan->tanggal_kunjungan = Carbon::parse($request->tanggal_kunjungan);
        $kunjungan->save();

        return response()->json([
            'error' => false,
            'kunjungan'  => $kunjungan,
        ], 200);
    }

    public function showDeleteKunjunganForm($id)
    {
        $kunjungan = Kunjungan::find($id);

        return response()->json([
            'error' => false,
            'kunjungan' => $kunjungan,
        ], 200);
    }

    public function deleteKunjungan($id)
    {
        $kunjungan = Kunjungan::destroy($id);

        return response()->json([
            'error' => false,
            'kunjungan' => $kunjungan,
        ], 200);
    }


    public function setKategori($id)
    {

        $kohort = Kohort::find($id);
        
        $skor = 2;

        // terlalu muda hamil <= 16
        if($kohort->pasien->umur <= 16) $skor += 4;
        // telalu tua hamil 1 >=35 
        if($kohort->hamil == 1 and $kohort->pasien->umur >= 35) $skor += 4;
        // terlalu cepat hamil lagi (jarak kehamilan <2  thn)
        if($kohort->hamil > 1 and $kohort->jarak_kehamilan < 2) $skor +=4;
        // terlalu lama hamil lagi (jarak kehamilan >= 10 thn)
        if($kohort->hamil > 1 and $kohort->jarak_kehamilan >= 10) $skor += 4;
        // terlalu banyak anak, 4/lebih
        if($kohort->hamil >= 4) $skor += 4;
        // terlalu tua, umur >= 35 thn
        if($kohort->pasien->umur >= 35) $skor += 4;
        // terlalu pendek <= 145 cm
        if($kohort->tinggi_badan <= 145) $skor += 4;
        // pernah gagal kehamilan
        if($kohort->gagal_hamil == 1) $skor += 4;

        // riwayat melahirkan
        $riwayat_melahirkan = array("tang_vakum", "uji_dirogoh", "infus_transfusi");
        foreach (explode(',', $kohort->riwayat_melahirkan) as $item) {
            if(in_array($item, $riwayat_melahirkan))
            {
                $skor += 4;
            }
        }

        // pernah operasi sesar
        if($kohort->operasi_sesar == 1) $skor += 8;



        $kunjungans = Kunjungan::where('id_kohort', $kohort->id)->get();

        $penyakit = array();
        foreach ($kunjungans as $kunjungan) {
            if($kunjungan->penyakit != null)
            {
                foreach (explode(',', $kunjungan->penyakit) as $item) 
                {
                    array_push($penyakit, $item);
                }
                
            }
        }

        $penyakit = array_unique($penyakit);

        // penyakit yang muncul poin 4
        $kategori1 = array( "anemia", "malaria", "tuberkolosa_paru", "payah_jantung", 
                            "kencing_manis", "penyakit_menular", 
                            "bengkak_muka_dan_tekanan_darah_tinggi", "hamil_kembar", 
                            "kembar_air", "janin_mati", "hamil_lebih"
                        );

        foreach ($penyakit as $item) {
            if(in_array($item, $kategori1))
            {
                $skor += 4;
            }
        }

        // penyakit yang muncul poin 8
        $kategori2 = array("bayi_sungsang", "bayi_lintang", "pendarahan", "kejang");

        foreach ($penyakit as $item) {
            if(in_array($item, $kategori2))
            {
                $skor += 8;
            }
        }
        
        $kategori = $this->kategori($skor);

        $pasien = Pasien::find($kohort->pasien->id);
        $pasien->kategori = $kategori;
        $pasien->skor = $skor;

        $pasien->save();

    }

    public function kategori($skor)
    {
        if ($skor == 2) return "Rendah";
        if ($skor >= 6 and $skor <=10) return "Tinggi";
        if ($skor >= 12) return "Sangat Tinggi";

    }

    public function showData()
    {
        return view('bidan.data');
    }

    public function showDataDesa()
    {
        // $desa = Desa::where('id_desa', Auth::user()->id_desa);
        // $data = Pasien::whereHas('bidan', function($query){
        //     $query->where('id_desa', Auth::user()->id_desa);
        // })->where('kategori', 'Sangat Tinggi')->get();

        $data = DB::table('pasien')
                    ->join('users', 'users.id', '=', 'pasien.id_bidan')
                    ->select('pasien.kategori', DB::raw('count(pasien.kategori) as num'))
                    ->where('users.id', Auth::user()->id)
                    ->groupBy('kategori')
                    ->orderBy('kategori', 'asc')
                    ->get();
            
        // dd($data->toJson());

        return response()->json($data);

        // dd($data->count('kategori')->groupBy('kategori'));


    }


    public function setAutoKategori()
    {

        $kohort = Kohort::all();

        foreach ($kohort as $item) {
            // echo $item->id;
            // echo "<br>";
            $this->setKategori($item->id);

        }


    }

}
