<?php

namespace App\Http\Controllers;


use App\Imports\SantriImport;
use App\Models\Asrama;
use App\Exports\SantriExport;
use App\Models\KategoriPaket;
use App\Models\Santri;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class SantriController extends Controller
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
        $santri = Santri::all();
        $asrama = Asrama::all();
        Session::put('menu','santri');
        return view('admin.Santri.santri',compact('santri','asrama'));
        // dd($santri);
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_santri' => 'required|max:255',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $santri = new santri;
        $santri->nis = $request->nis;
        $santri->nama_santri = $request->nama_santri;
        $santri->alamat = $request->alamat;
        $santri->total_paket_diterima = $request->total_paket_diterima;
        $santri->asrama = $request->input('asrama');
        $santri->save();
        return redirect('santri_admin')
        ->with('success','New data santri successfully added!');
    }

    public function update(Request $request,$nis)
    {
        $validator = Validator::make($request->all(), [
            'nama_santri' => 'required|max:255',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }

        // dd($nis);
        // $santri = Santri::find($nis);
        $santri=Santri::where('nis',$nis)->first();
        $santri->nama_santri = $request->nama_santri;
        $santri->alamat = $request->alamat;
        $santri->total_paket_diterima = $request->total_paket_diterima;
        $santri->asrama = $request->input('id_asrama');

        $santri = $request->all();
        return redirect('santri_admin')
        ->with('success','Data kategoripaket successfully updated!');
    }

    public function delete($nis)
    {
        Santri::where('nis',$nis)->delete();
         return redirect('santri_admin')
         ->with('success','Data kategoripaket successfully deleted!');
    }
    public function import(Request $request) 
	{
		// validasi
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		// menangkap file excel
		$file = $request->file('file');
 
		// membuat nama file unik
		$nama_file = rand().$file->getClientOriginalName();
 
		// upload ke folder file_kategoripaket di dalam folder public
		$file->move('file_santri',$nama_file);
 
		// import data
		Excel::import(new SantriImport, public_path('/file_santri/'.$nama_file));
 
		// notifikasi dengan session
		Session::flash('sukses','Data kategoripaket Berhasil Diimport!');
 
		// alihkan halaman kembali
		return redirect('santri_admin');
	}

    public function exsport()
	{
		return Excel::download(new SantriExport, 'santri.xlsx');
	}
}
