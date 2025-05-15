<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class LaporanController extends Controller
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
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = Paket::query();
    
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_diterima', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('tanggal_diterima', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('tanggal_diterima', '<=', $request->end_date);
        }
    
        $paket = $query->get();
    
        return view('admin.Laporan.laporanmasuk', compact('paket'));
    }
    public function index2(Request $request)
    {
        $query = Paket::query();
    
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $query->whereBetween('tanggal_diterima', [$request->start_date, $request->end_date]);
        } elseif ($request->filled('start_date')) {
            $query->whereDate('tanggal_diterima', '>=', $request->start_date);
        } elseif ($request->filled('end_date')) {
            $query->whereDate('tanggal_diterima', '<=', $request->end_date);
        }
    
        $paket = $query->get();
    
        return view('admin.Laporan.laporankeluar', compact('paket'));
    }
    
    // use AuthorizesRequests, ValidatesRequests;
}
