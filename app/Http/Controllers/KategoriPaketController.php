<?php

namespace App\Http\Controllers;

use App\Imports\kategoripaketImport;
use App\Models\KategoriPaket;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class KategoriPaketController extends Controller
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
        $kategoripaket = KategoriPaket::all();
        Session::put('menu','kategoripaket');
        return view('admin.kategoripaket.kategoripaket',compact('kategoripaket'));
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|max:255',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $kategoripaket = new kategoripaket;
        $kategoripaket->nama_kategori = $request->nama_kategori;
        $kategoripaket->save();
        return redirect('kategoripaket_admin')
        ->with('success','New data kategoripaket successfully added!');
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'nama_kategori' => 'required|max:255',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $kategoripaket = kategoripaket::find($id);
        $kategoripaket->nama_kategori = $request->nama_kategori;
        $kategoripaket->save();
        return redirect('kategoripaket_admin')
        ->with('success','Data kategoripaket successfully updated!');
    }

    public function delete($id)
    {
        kategoripaket::find($id)->delete();
         return redirect('kategoripaket_admin')
         ->with('success','Data kategoripaket successfully deleted!');
    }
    // public function import(Request $request) 
	// {
	// 	// validasi
	// 	$this->validate($request, [
	// 		'file' => 'required|mimes:csv,xls,xlsx'
	// 	]);
 
	// 	// menangkap file excel
	// 	$file = $request->file('file');
 
	// 	// membuat nama file unik
	// 	$nama_file = rand().$file->getClientOriginalName();
 
	// 	// upload ke folder file_kategoripaket di dalam folder public
	// 	$file->move('file_kategoripaket',$nama_file);
 
	// 	// import data
	// 	Excel::import(new kategoripaketImport, public_path('/file_kategoripaket/'.$nama_file));
 
	// 	// notifikasi dengan session
	// 	Session::flash('sukses','Data kategoripaket Berhasil Diimport!');
 
	// 	// alihkan halaman kembali
	// 	return redirect('kategoripaket_admin');
	// }
}
