<?php

namespace App\Http\Controllers;

use App\Models\Asrama;
use App\Models\KategoriPaket;
use App\Models\Paket;
use App\Models\Santri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
                /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        $paket = Paket::all();
        $santri = Santri::all();
        $asrama = Asrama::all();
        $kategori = KategoriPaket::all();
        Session::put('menu','paket');
        return view('admin.paket.paket',compact('paket','santri','asrama','kategori'));
    }

    public function tambah()
    {
        $paket = Paket::all();
        $santri = Santri::all();
        $asrama = Asrama::all();
        $kategori = KategoriPaket::all();
        return view('admin.paket.tambah',compact('paket','santri','asrama','kategori'));
    }

    public function insert(Request $request)
    {
        $paket = new paket();
        $paket->nama_paket = $request->nama_paket;
        $paket->tanggal_diterima = $request->tanggal_diterima;
        $paket->kategori_paket = $request->kategori_paket;
        $paket->penerima_paket = $request->penerima_paket;
        $paket->asrama = $request->asrama;
        $paket->pengirim_paket = $request->pengirim_paket;
        $paket->isi_paket_yang_disita = $request->isi_paket_yang_disita;
        $paket->status_paket = $request->status_paket;
        $paket->save();
        return redirect('paket_admin')->with('status', "data Berhasil Ditambahkan!");
    }
    public function edit($id)
    {
        $paket = Paket::find($id);
        $santri = Santri::all();
        $asrama = Asrama::all();
        $kategori = KategoriPaket::all();
        return view('admin.paket.edit',compact('paket','santri','asrama','kategori'));
    }

    public function update(Request $request,$id)
    {
        // $validator = Validator::make($request->all(), [
        //     'nama_paket' => 'required|max:255',
        // ]);
 
        // if ($validator->fails()) {
        //     return back()->with('error', $validator->messages()->all()[0])->withInput();
        // }
        $paket = paket::find($id);
        $paket->nama_paket = $request->nama_paket;
        $paket->tanggal_diterima = $request->tanggal_diterima;
        $paket->kategori_paket = $request->kategori_paket;
        $paket->penerima_paket = $request->penerima_paket;
        $paket->pengirim_paket = $request->pengirim_paket;
        $paket->isi_paket_yang_disita = $request->isi_paket_yang_disita;
        $paket->status_paket = $request->status_paket;
        $paket->save();
        return redirect('paket_admin')
        ->with('success','Data paket successfully updated!');
    }

    public function delete($id)
    {
        paket::find($id)->delete();
         return redirect('paket_admin')
         ->with('success','Data paket successfully deleted!');
    }
}
