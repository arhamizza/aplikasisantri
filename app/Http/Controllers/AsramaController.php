<?php

namespace App\Http\Controllers;

use App\Models\Asrama;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AsramaController extends Controller
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
        $asrama = Asrama::all();
        Session::put('nama_asrama','gedung');
        return view('admin.Asrama.asrama',compact('asrama'));
    }

    public function create(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nama_asrama' => 'required|max:255',
            'bobot' => 'required',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $asrama = new asrama;
        $asrama->nama_asrama = $request->nama_asrama;
        $asrama->bobot = $request->bobot;
        $asrama->save();
        return redirect('asrama_admin')
        ->with('success','New data asrama successfully added!');
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'nama_asrama' => 'required|max:255',
        ]);
 
        if ($validator->fails()) {
            return back()->with('error', $validator->messages()->all()[0])->withInput();
        }
        $asrama = asrama::find($id);
        $asrama->nama_asrama = $request->nama_asrama;
        $asrama->save();
        return redirect('asrama_admin')
        ->with('success','Data asrama successfully updated!');
    }

    public function delete($id)
    {
        asrama::find($id)->delete();
         return redirect('asrama_admin')
         ->with('success','Data asrama successfully deleted!');
    }
}
