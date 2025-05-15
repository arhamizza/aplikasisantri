<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Models\Alternatif;
use App\Models\Datatable;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Kriteria;
use App\Models\Siswa;
use App\Models\Tabel;
use App\Models\Transaksi;
use App\Models\TransaksiGuruSiswa;
use App\Models\TransaksiGuruu;
use App\Models\TransaksiSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index() 
    {
        $tabel = Tabel::all();
        return view('users.index', compact('tabel'));
        // dd($tabel);
    }
    public function useralternatif() 
    {
        $alternatif = Alternatif::all();
        return view('users.alternatifuser', compact('alternatif'));
        // dd($tabel);
    }
    public function userkriteria() 
    {
        $kriteria = Kriteria::all();
        return view('users.kriteriauser', compact('kriteria'));
        // dd($tabel);
    }
    public function usersiswa() 
    {
        $siswa = Siswa::all();
        return view('users.siswauser', compact('siswa'));
        // dd($tabel);
    }
    public function userkelas() 
    {
        $kelas = Kelas::all();
        return view('users.kelasuser', compact('kelas'));
        // dd($tabel);
    }
    public function transaksi()
    {
        $gurus = Guru::all();
        $kelas = Kelas::all();
        $siswa = Siswa::all();
        $transaksi = Transaksi::all();
        // $tran = DB::table('transaksi_gurus')->select('id_guru')->distinct()->get();
        Session::put('menu','transaksi');
        // dd($tran);
        return view('users.transaksiuser',compact('gurus','transaksi','kelas','siswa'));
    }
    public function view($id)
    {
        $transaksi = Transaksi::find($id);
        $gurus = Guru::all();
        $kelas = Kelas::all();
        $siswas = Siswa::all();
        // $transaksi = Transaksi::all();
        $transaksigurus = TransaksiGuruu::where('id_transaksi', $id)->where('id_guru', Auth::id())->first();
        // $transaksigurus = TransaksiGuruu::where('id_transaksi', $id)->where('user_id', Auth::id())->get();
        $transaksisiswa = TransaksiSiswa::where('id_transaksi', $id)->get();
        // dd($transaksigurus);
        return view('users.user',compact('gurus','transaksi','kelas','siswas','transaksisiswa','transaksigurus'));

    }

    public function vieww($id ,$id_siswa)
    {
        $transaksi = Transaksi::find($id);
        $transaksii = TransaksiSiswa::where('id_transaksi', $id)->where('id_siswa', $id_siswa)->first();
        $viewtabel= TransaksiGuruSiswa::where('id_transaksi', $id)->where('id_siswa', $id_siswa)->where('id_guru', Auth::id())->get();
        $viewtabel2= TransaksiGuruSiswa::where('id_transaksi', $id)->where('id_siswa', $id_siswa)->first();
        $gurus = Guru::all();
        $kelas = Kelas::all();
        $kriteria = Kriteria::all();
        $tabel = Tabel::all();
        // dd($transaksii);
        return view('users.usernilai',compact('gurus','transaksi','transaksii','kelas','kriteria','tabel','viewtabel','viewtabel2'));

    }
    public function nilai_user($id_guru)
    {
        $gurus = Guru::all();
        $kelas = Kelas::all();
        $siswa = Siswa::orderBy('id_kelas')->get();
        $transaksi = Transaksi::orderBy('id')->get();
        $tabel = Tabel::all();

            return view('users.nilaiuser', 
            compact('transaksi_gurusss','transaksi_guruss','siswa','tabel','id_guru','transaksi','transaksigurus'));
       
            return redirect('/')->where('id_guru', "Slug doesnot exists");
        
    }
    public function create_nilai(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'id_transaksi' => 'required',
            'id_siswa' => 'required',
            'id_kriteria' => 'required',
            'nilai' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $transaksi = new TransaksiGuruSiswa();
        $transaksi->id_transaksi = $request->id_transaksi;
        $transaksi->id_siswa = $request->id_siswa;
        $transaksi->id_guru = Auth::id();
        $transaksi->id_kriteria = $request->id_kriteria;
        $transaksi->nilai = $request->nilai;
        $transaksi->save();
        return redirect('transaksigurusiswa_next/'.$request->id_transaksi. '/' .$request->id_siswa)
        ->with('success','New data transaksi successfully added!');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nilai' => 'required',
            'id_kriteria' => 'required',
            'id_transaksi' => 'required',
            'id_siswa' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $transaksi = TransaksiGuruSiswa::find($id);
        $transaksi->id_transaksi = $request->id_transaksi;
        $transaksi->id_siswa = $request->id_siswa;
        $transaksi->nilai = $request->nilai;
        // if($request->filled('id_linguistik')) {
        //     $transaksi->Nilai_linguistik = $request->id_linguistik;
        // } else {
        //     $transaksi->Nilai_linguistik = $request->null;
        // }
        // dd($transaksi);
        $transaksi->update();
        return redirect('transaksigurusiswa_next/'.$request->id_transaksi. '/' .$request->id_siswa)
        ->with('success','Data transaksi successfully updated!');
    }

    
}
