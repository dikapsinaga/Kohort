<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Desa;
use App\User;
use App\Puskesmas;
use App\Pasien;
use App\Kohort;
use App\Kunjungan;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('isAdmin');
    }

    public function showRegisterForm()
    {
        $list_desa = Desa::where('id_puskesmas', Auth::user()->id_puskesmas)->get();
        $nama_puskesmas = User::find(Auth::user()->id)->puskesmas->nama;
        return view('admin.registerBidan', ['nama_puskesmas'=>$nama_puskesmas,'list_desa'=>$list_desa]);
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'id_puskesmas' => ['required', 'int'],
            'id_desa' => ['required', 'int']
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'id_puskesmas' => $data['id_puskesmas'],
            'id_desa' => $data['id_desa']
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect(url('/admin/users'));
    }

    public function showUsers()
    {

        $users = User::with('puskesmas','desa')
                ->where('role','!=','0')
                ->where('id','!=',Auth::user()->id)
                ->where('id_puskesmas',Auth::user()->id_puskesmas)
                ->whereNotNull('id_puskesmas')
                ->get();

        return view('admin.showUsers', ['users'=> $users]);
    }

    public function show($id)
    {
        $user = User::find($id);

        return response()->json([
            'error' => false,
            'user' => $user,
        ], 200);
    }

    public function destroy($id)
    {
        $user= User::destroy($id);

        return response()->json([
            'error' => false,
            'user'  => $user,
        ], 200);
    }

    public function showEditForm($id)
    {
        $user = User::with('puskesmas', 'desa')->find($id);
        $list_desa = Desa::where('id_puskesmas', Auth::user()->id_puskesmas)->get();

        return response()->json([
            'error' => false,
            'user' => $user,
            'list_desa' => $list_desa,
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), array(
            'name' => ['required', 'string', 'max:255'],
            'email' => ['sometimes','required', 'string', 'email', 'max:255', "unique:users,email, $id"],
            // 'password' => ['', 'string', 'min:8', 'confirmed'],
            'id_puskesmas' => ['required', 'int'],
            'id_desa' => ['required', 'int']

        ));


        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $user = User::find($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->id_puskesmas = $request->input('id_puskesmas');
        $user->id_desa = $request->input('id_desa');

        $user->save();

        return response()->json([
            'error' => false,
            'users'  => $user,
        ], 200);
    }

    public function showPasien()
    {        
        return view('admin.showPasien');
    }

    public function getListPasien()
    {
        $pasien = Pasien::whereHas('bidan', function($query){
            $query->whereHas('desa', function($query){
                $query->where('id_puskesmas', Auth::user()->id_puskesmas);
            });
        })->with('bidan.desa')->get();


        // $pasien = Pasien::with(['bidan' => function($query){
        //     $query->where('id_puskesmas', '3')->with(['desa' => function($query){
        //         $query->where('id_puskesmas', '5');
        //     }]);
        // }])->get();
        
        // $pasien = Pasien::with('bidan.desa')->get();
        // $pasien = Pasien::with('bidan')
        // dd($pasien);

        return response()->json([
            'error' => false,
            'pasien' => $pasien,
        ], 200);

    }

    public function showDetails($id)
    {
        // $details = Kunjungan::whereHas('kohort', function($query) use ($id){
        //     $query->whereHas('pasien', function($query) use($id) {
        //         $query->where('id', $id);
        //     });
        // })->with('kohort.pasien')->get();


        $details = Kohort::with('pasien')->where('id_pasien',$id)->first();

        // $kunjungans = Kunjungan::where('id_kohort', $details->id)->get();
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
        $desa = Desa::where('id_puskesmas', Auth::user()->id_puskesmas)->get();
        return view('admin.data', ['desa' => $desa]);
    }

    public function showDataPuskesmas()
    {
        $data = DB::table('pasien')
                    ->join('users', 'users.id', '=', 'pasien.id_bidan')
                    ->select('pasien.kategori', DB::raw('count(pasien.kategori) as num'))
                    ->where('users.id_puskesmas', Auth::user()->id_puskesmas)
                    ->groupBy('kategori')
                    ->orderBy('kategori', 'asc')
                    ->get();

        return response()->json($data);

    }

    public function showDataDesa($id)
    {
        $data = DB::table('pasien')
                    ->join('users', 'users.id', '=', 'pasien.id_bidan')
                    ->select('pasien.kategori', DB::raw('count(pasien.kategori) as num'))
                    ->where('users.id_desa', $id)
                    ->groupBy('kategori')
                    ->orderBy('kategori', 'asc')
                    ->get();

        return response()->json($data);

    }

    

    

    



}

