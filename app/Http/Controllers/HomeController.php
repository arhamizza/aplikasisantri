<?php

namespace App\Http\Controllers;


use App\Models\KategoriPaket;
use App\Models\Paket;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
    public function index()
    {
        $data = Paket::select(
            DB::raw('DATE(tanggal_diterima) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $kategori = KategoriPaket::select(
            DB::raw('nama_kategori as kategori'),
            DB::raw('COUNT(*) as total2')
        )
            ->groupBy('kategori')
            ->orderBy('kategori')
            ->get();

        $labels = $data->pluck('date');
        $labels2 = $kategori->pluck('kategori');
        $totals = $data->pluck('total');
        $totals2 = $kategori->pluck('total2');

        $paket = Paket::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard.dashboard', compact('labels', 'totals','labels2','totals2','paket'));
    }
    public function index2()
    {
        $data = Paket::select(
            DB::raw('DATE(tanggal_diterima) as date'),
            DB::raw('COUNT(*) as total')
        )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
        $kategori = KategoriPaket::select(
            DB::raw('nama_kategori as kategori'),
            DB::raw('COUNT(*) as total2')
        )
            ->groupBy('kategori')
            ->orderBy('kategori')
            ->get();

        $labels = $data->pluck('date');
        $labels2 = $kategori->pluck('kategori');
        $totals = $data->pluck('total');
        $totals2 = $kategori->pluck('total2');

        $paket = Paket::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard.dashboard2', compact('labels', 'totals','labels2','totals2','paket'));
    }
    use AuthorizesRequests, ValidatesRequests;
}
