<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\DataPeran;
use App\Models\Guru;
use App\Models\Kriteria;
use App\Models\Siswa;
use App\Models\TransaksiGuruSiswa;
use App\Models\TransaksiPenilai;
use App\Models\TransaksiPenilaiPelamar;
use Illuminate\Http\Request;

class AnalisisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $dataTransaksi = TransaksiGuruSiswa::select('id_transaksi')->orderBy('id_transaksi', 'asc')->distinct()->get();
        $penilai = Guru::select('id', 'bobot')->orderBy('bobot', 'desc')->get();
        $dataKriteria = TransaksiGuruSiswa::select('id_kriteria')->orderBy('id_kriteria', 'asc')->distinct()->get();
        $dataAlternatif = TransaksiGuruSiswa::select('id_siswa')->orderBy('id_siswa', 'asc')->distinct()->get();
// dd($penilai);
        $data = array(
            'transaksi' => 1,
            'penilai' => array('1' => array('alternatif1' => array('A' => 1, 'B' => 3, 'C' => 4, 'D' => 5)))
        );

        // Step 3 : incorporating DM weight
        $dataPen = array();
        foreach ($penilai as $pen) {
            $dataPel = array();
            foreach ($dataAlternatif as $pel) {
                $dataKrit = array();
                foreach ($dataKriteria as $krit) {
                    $dataT = TransaksiGuruSiswa::select('id_siswa', 'id_guru', 'id_kriteria', 'nilai')
                        ->where('id_kriteria', $krit->id_kriteria)->where('id_guru', $pen->id)->where('id_siswa', $pel->id_siswa)->get();
                    $dataAlt = array();
                    foreach ($dataT as $d) {
                        array_push(
                            $dataAlt,
                            array(
                                'A' => 1 - pow((1 - $d->linguistik->A), 3 * $pen->bobot),
                                'B' => 1 - pow((1 - $d->linguistik->B), 3 * $pen->bobot),
                                'C' => 1 - pow((1 - $d->linguistik->C), 3 * $pen->bobot),
                                'D' => 1 - pow((1 - $d->linguistik->D), 3 * $pen->bobot)
                            )
                        );
                    }
                    array_push($dataKrit, array('kriteria' => $krit->id_kriteria, 'data' => $dataAlt));
                }
                array_push($dataPel, array('alternatif' => $pel->id_siswa, 'data' => $dataKrit));
            }
            array_push($dataPen, array('penilai' => $pen->nama_guru, 'data' => $dataPel));
        }

        // dd($dataPen);

        // step 4 calculating inclusion comparison possibility
        // p-
        // dd($dataPen);

        $allDataKriteria = array();

        for ($i = 0; $i <= count($dataPen) - 1; $i++) {
            $valKriteria = array();
            foreach ($dataPen[$i]['data'] as $valPen) {
                foreach ($valPen['data'] as $valAlt) {
                    foreach ($valAlt['data'] as $valKrit) {
                        array_push($valKriteria, $valKrit);
                    }
                }
            }
            array_push($allDataKriteria, array('penilai' => $dataPen[$i]['penilai'], 'data' => $valKriteria));

        }
        // dd($allDataKriteria);

        $pMinus = array();

        for ($i = 0; $i < count($allDataKriteria); $i++) {
            for ($m = 0; $m < count($allDataKriteria); $m++) {
                $compare = array();
                for ($j = 0; $j < count($allDataKriteria[$i]['data']); $j++) {
                    $varA1 = $allDataKriteria[$m]['data'][$j]['A'];
                    $varB2 = $allDataKriteria[$m]['data'][$j]['B'];
                    $varC3 = $allDataKriteria[$m]['data'][$j]['C'];
                    $varD4 = $allDataKriteria[$m]['data'][$j]['D'];

                    $varA = $allDataKriteria[$i]['data'][$j]['A'];
                    $varB = $allDataKriteria[$i]['data'][$j]['B'];
                    $varC = $allDataKriteria[$i]['data'][$j]['C'];
                    $varD = $allDataKriteria[$i]['data'][$j]['D'];

                    $compare[] = MAX(1 - MAX(((1 - $varC3) - $varA) / ((1 - $varA - $varD) + (1 - $varB2 - $varC3)), 0), 0);
                }
                array_push($pMinus, $compare);
            }
        }
        $pPlus = array();

        for ($i = 0; $i < count($allDataKriteria); $i++) {
            for ($m = 0; $m < count($allDataKriteria); $m++) {
                $compare = array();
                for ($j = 0; $j < count($allDataKriteria[$i]['data']); $j++) {
                    $varA1 = $allDataKriteria[$m]['data'][$j]['A'];
                    $varB2 = $allDataKriteria[$m]['data'][$j]['B'];
                    $varC3 = $allDataKriteria[$m]['data'][$j]['C'];
                    $varD4 = $allDataKriteria[$m]['data'][$j]['D'];

                    $varA = $allDataKriteria[$i]['data'][$j]['A'];
                    $varB = $allDataKriteria[$i]['data'][$j]['B'];
                    $varC = $allDataKriteria[$i]['data'][$j]['C'];
                    $varD = $allDataKriteria[$i]['data'][$j]['D'];

                    $compare[] = MAX(1 - MAX(((1 - $varD4) - $varB) / ((1 - $varB - $varC) + (1 - $varA1 - $varD4)), 0), 0);
                }
                array_push($pPlus, $compare);
            }
        }
        // dd($pPlus);

        $hasilRata = array();
        for ($i = 0; $i < count($pMinus); $i++) {
            $valRata = array();
            for ($j = 0; $j < count($pPlus[$i]); $j++) {
                $val = ($pPlus[$i][$j] + $pMinus[$i][$j]) / 2;
                $valRata[] = $val;
            }
            array_push($hasilRata, $valRata);
        }
        // dd($hasilRata);

        $hasilJumlah = array();
        for ($i = 0; $i < count($dataPen); $i++) {
            $dataJml = array();
            if ($i == 0) {
                for ($j = 0; $j < count($hasilRata[0]); $j++) {

                    $col3 = $hasilRata[3][$j];
                    $col4 = $hasilRata[4][$j];
                    $col5 = $hasilRata[5][$j];

                    $val = ($col3 + $col4 + $col5 + 3 / 2 - 1) / 3 * (3 - 1);
                    $dataJml[] = $val;
                }
            } else if ($i == 1) {
                for ($j = 0; $j < count($hasilRata[0]); $j++) {

                    $col2 = $hasilRata[2][$j];
                    $col3 = $hasilRata[3][$j];
                    $col4 = $hasilRata[4][$j];

                    $val = ($col2 + $col3 + $col4 + 3 / 2 - 1) / 3 * (3 - 1);
                    $dataJml[] = $val;
                }
            } else {
                for ($j = 0; $j < count($hasilRata[0]); $j++) {

                    $col6 = $hasilRata[6][$j];
                    $col7 = $hasilRata[7][$j];
                    $col8 = $hasilRata[8][$j];

                    $val = ($col6 + $col7 + $col8 + 3 / 2 - 1) / 3 * (3 - 1);
                    $dataJml[] = $val;
                }
            }
            array_push($hasilJumlah, $dataJml);
        }

        // rank
        $mergeArray = array();
        foreach ($hasilJumlah as $hasil) {
            if ($mergeArray == null) {
                foreach ($hasil as $key => $h) {
                    array_push($mergeArray, array($h));
                }
                // dd($mergeArray);
            } else {
                foreach ($hasil as $key => $h) {
                    array_push($mergeArray[$key], $h);
                    // rsort($mergeArray[$key]);
                }
            }
        }

        function getRanks($arrays)
        {
            $ranks = [];
            foreach ($arrays as $index => $array) {
                $rank = [];
                foreach ($array as $key => $value) {
                    $count = 1;
                    foreach ($array as $otherValue) {
                        if ($value < $otherValue) {
                            $count++;
                        }
                    }
                    $rank[$key] = $count;
                }
                $ranks[$index] = $rank;
            }
            return $ranks;
        }

        $ranks = getRanks($mergeArray);


        // dd($allDataKriteria);
        // dd($ranks);

        $dataRank = [];

        foreach ($ranks as $ky => $val) {
            $data = [];
            foreach ($val as $k => $v) {
                $cek = $allDataKriteria[$k]['data'][$ky];

                $data[$v] = $cek;

            }
            array_push($dataRank, $data);
        }
        // dd($dataPen);
        // dd($data);
        
        $alldataRank = array();
        
        for ($i = 1; $i <= count($dataPen); $i++) {
            $dataRankList = array();
            foreach ($dataRank as $data) {
                foreach ($data as $ky => $d) {
                    if ($ky == $i) {
                        array_push($dataRankList, $d);
                    }
                }
            }
            array_push($alldataRank, $dataRankList);
        }
        // dd($alldataRank);

        $rankBobot = [0.2429, 0.5142, 0.2429];
        $dataD = array();
        for ($i = 0; $i < count($ranks); $i++) {
            $sumAList = null;
            $sumBList = null;
            $sumCList = null;
            $sumDList = null;
            for ($j = 0; $j < count($alldataRank); $j++) {
                $A1 = $alldataRank[$j][$i]['A'];
                $B1 = $alldataRank[$j][$i]['B'];
                $C1 = $alldataRank[$j][$i]['C'];
                $D1 = $alldataRank[$j][$i]['D'];

                $sumA = pow((1 - $A1), $rankBobot[$j]);
                $sumB = pow((1 - $B1), $rankBobot[$j]);
                $sumC = pow((1 - $C1), $rankBobot[$j]);
                $sumD = pow((1 - $D1), $rankBobot[$j]);

                if ($sumAList == null) {
                    $sumAList = $sumA;
                    $sumBList = $sumB;
                    $sumCList = $sumC;
                    $sumDList = $sumD;
                } else {
                    $sumAList = $sumAList * $sumA;
                    $sumBList = $sumBList * $sumB;
                    $sumCList = $sumCList * $sumC;
                    $sumDList = $sumDList * $sumD;
                }
            }
            $A = 1 - $sumAList;
            $B = 1 - $sumBList;
            $C = 1 - $sumCList;
            $D = 1 - $sumDList;

            array_push($dataD, ['A' => $A, 'B' => $B, 'C' => $C, 'D' => $D]);
        }

        $split = array_chunk($dataD, count($dataKriteria));

        // step 7 calculate IVIFN EVALUATION
        // dd($split);
        $pis = array();
        for ($i = 0; $i < count($dataKriteria); $i++) {
            // dd($dataKriteria[0]);
            $AList = array();
            $BList = array();
            $CList = array();
            $DList = array();
            for ($j = 0; $j < count($dataAlternatif); $j++) {
                $A = $split[$j][$i]['A'];
                $B = $split[$j][$i]['B'];
                $C = $split[$j][$i]['C'];
                $D = $split[$j][$i]['D'];

                $AList[] = $A;
                $BList[] = $B;
                $CList[] = $C;
                $DList[] = $D;
            }
            // dd($BList);
            array_push($pis, ['A' => max($AList), 'B' => max($BList), 'C' => min($CList), 'D' => min($DList)]);

        }
        // dd($pis);
        $nis = array();
        for ($i = 0; $i < count($dataKriteria); $i++) {
            // dd($dataKriteria[0]);
            $AList = array();
            $BList = array();
            $CList = array();
            $DList = array();
            for ($j = 0; $j < count($dataAlternatif); $j++) {
                $A = $split[$j][$i]['A'];
                $B = $split[$j][$i]['B'];
                $C = $split[$j][$i]['C'];
                $D = $split[$j][$i]['D'];

                $AList[] = $A;
                $BList[] = $B;
                $CList[] = $C;
                $DList[] = $D;
            }
            // dd($BList);
            array_push($nis, ['A' => min($AList), 'B' => min($BList), 'C' => max($CList), 'D' => max($DList)]);

        }


        // step 8 calculate inclusion probabilitas
        // p- a+
        $PminA = array();
        for ($i = 0; $i < count($pis); $i++) {
            $sumData = array();
            for ($j = 0; $j < count($split); $j++) {
                $Apis = $pis[$i]['A'];
                $Dpis = $pis[$i]['D'];

                $Bsplit = $split[$j][$i]['B'];
                $Csplit = $split[$j][$i]['C'];
                if ($j == 1) {

                    $sum = MAX(1 - MAX(((1 - $Bsplit) - $Apis) / ((1 - $Apis - $Dpis) + (1 - $Bsplit - $Csplit)), 0), 0);
                } else {
                    $sum = MAX(1 - MAX(((1 - $Csplit) - $Apis) / ((1 - $Apis - $Dpis) + (1 - $Bsplit - $Csplit)), 0), 0);
                }
                $sumData[] = $sum;
            }
            array_push($PminA, $sumData);
        }
        // p+ a+
        $PplusA = array();
        for ($i = 0; $i < count($pis); $i++) {
            $sumData = array();
            for ($j = 0; $j < count($split); $j++) {
                $Bpis = $pis[$i]['B'];
                $Cpis = $pis[$i]['C'];

                $Asplit = $split[$j][$i]['A'];
                $Dsplit = $split[$j][$i]['D'];

                $sum = MAX(1 - MAX(((1 - $Dsplit) - $Bpis) / ((1 - $Bpis - $Cpis) + (1 - $Asplit - $Dsplit)), 0), 0);

                $sumData[] = $sum;
            }
            array_push($PplusA, $sumData);
        }

        // p
        $hasilP = array();
        for ($i = 0; $i < count($pis); $i++) {
            $sumData = array();
            for ($j = 0; $j < count($split); $j++) {

                $sum = ($PminA[$i][$j] + $PplusA[$i][$j]) / 2;
                $sumData[] = $sum;
            }
            array_push($hasilP, $sumData);
        }
        // dd($hasilP);

        // q- a+

        $QminA = array();
        for ($i = 0; $i < count($nis); $i++) {
            $sumData = array();
            for ($j = 0; $j < count($split); $j++) {
                $Bnis = $nis[$i]['B'];
                $Cnis = $nis[$i]['C'];

                $Asplit = $split[$j][$i]['A'];
                $Dsplit = $split[$j][$i]['D'];

                $sum = MAX(1 - MAX(((1 - $Cnis) - $Asplit) / ((1 - $Asplit - $Dsplit) + (1 - $Bnis - $Cnis)), 0), 0);
                $sumData[] = $sum;
            }
            array_push($QminA, $sumData);
        }
        $QplusA = array();
        for ($i = 0; $i < count($nis); $i++) {
            $sumData = array();
            for ($j = 0; $j < count($split); $j++) {
                $Anis = $nis[$i]['A'];
                $Dnis = $nis[$i]['D'];

                $Bsplit = $split[$j][$i]['B'];
                $Csplit = $split[$j][$i]['C'];

                $sum = MAX(1 - MAX(((1 - $Dnis) - $Bsplit) / ((1 - $Bsplit - $Csplit) + (1 - $Anis - $Dnis)), 0), 0);
                $sumData[] = $sum;
            }
            array_push($QplusA, $sumData);
        }

        $hasilQ = array();
        for ($i = 0; $i < count($nis); $i++) {
            $sumData = array();
            for ($j = 0; $j < count($split); $j++) {

                $sum = ($QminA[$i][$j] + $QplusA[$i][$j]) / 2;
                $sumData[] = $sum;
            }
            array_push($hasilQ, $sumData);
        }
        // dd($hasil);


        //rank Q
        $kriteria = Kriteria::select('bobot')->pluck('bobot');
        // for ($i = 0; $i < count($kriteria); $i++) {
        $hasilPerhitungan = array();

        // Looping untuk menghitung rumus
        for ($i = 0; $i < count($dataAlternatif); $i++) {
            $rumusAtas = ($hasilQ[0][$i] * $kriteria[0] + $hasilQ[1][$i] * $kriteria[1] + $hasilQ[2][$i] * $kriteria[2]);
            $rumusBawah = (($hasilQ[0][$i] + $hasilP[0][$i]) * $kriteria[0] + ($hasilQ[1][$i] + $hasilP[1][$i]) * $kriteria[1] + ($hasilQ[2][$i] + $hasilP[2][$i]) * $kriteria[2]);

            $hasilAkhir = $rumusAtas / $rumusBawah;

            // Simpan hasil perhitungan ke dalam array
            $hasilPerhitungan[] = $hasilAkhir;
        }

        $hasilAkhir = array();


        $calon = Siswa::all();

        for ($i = 0; $i < count($hasilPerhitungan); $i++) {
            $hasilAkhir += array($calon[$i]['nama_siswa'] => $hasilPerhitungan[$i]);
        }
        arsort($hasilAkhir);
        // dd($hasilAkhir);
        $penilai = Guru::all();
        // dump($calon);
        return view('admin.Transaksi.index', compact('dataPen', 'hasilPerhitungan', 'calon', 'penilai', 'hasilAkhir'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}