@extends('layouts.app2', [
    'class' => '',
    'elementActive' => 'dashboard',
])

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h2 class="text-center">Grafik Data Masuk</h2>

                    <div style="width: 100%; max-width: 600px; margin: auto;">
                        <canvas id="chartMasuk"></canvas>
                    </div>
                </div>
                <div class="col">
                    <h2 class="text-center">Grafik Kategori Masuk</h2>
                    <div style="width: 100%; max-width: 600px; margin: auto;">
                        <canvas id="chartKeluar"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h3 class="mb-4 text-center">Data Paket Terbaru</h3>

        <table class="table table-bordered table-striped shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama paket</th>
                    <th>Tanggal Diterima</th>
                    <th>Kategori Paket</th>
                    <th>Penerima Paket</th>
                    <th>Asrama</th>
                    <th>Pengirim Paket</th>
                    <th>Isi Paket yang Disita</th>
                    <th>Status Paket</th>
                </tr>
            </thead>
            <tbody id="dataTableBody">
                @php
                    $no = 1;
                @endphp
                @foreach ($paket as $index => $d)
                    <tr class="{{ $index >= 5 ? 'd-none extra-row' : '' }}">
                        <td>{{ $no }}</td>
                        <td>{{ $d->nama_paket }}</td>
                        <td>{{ $d->tanggal_diterima }}</td>
                        <td>{{ $d->kategori->nama_kategori }}</td>
                        <td>{{ $d->santri->nama_santri }}</td>
                        <td>{{ $d->santri->asrama2->nama_asrama }}</td>
                        <td>{{ $d->pengirim_paket }}</td>
                        <td>{{ $d->isi_paket_yang_disita }}</td>
                        <td>{{ $d->status_paket }}</td>
                    </tr>
                    @php $no++; @endphp
                @endforeach
            </tbody>
        </table>
        <div class="text-center mt-3">
            <button id="toggleButton" class="btn btn-primary">Lihat Semua Data</button>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 ">
                <div class="card card-stats bg-secondary ">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-globe text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category text-primary">paket</p>
                                    <p class="card-title">{{ $paket->where('status_paket','belum_diambil')->count() }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <a href="{{ url('paket_admin') }}" class="fa fa-refresh">&nbsp;&nbsp;Paket Belum Diambil</a> 
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 ">
                <div class="card card-stats bg-secondary ">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="icon-big text-center icon-warning">
                                    <i class="nc-icon nc-vector text-warning"></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category text-primary">Paket</p>
                                    <p class="card-title">{{ $paket->where('status_paket','diambil')->count() }}
                                        <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <a href="{{ url('paket_admin') }}" class="fa fa-refresh">&nbsp;&nbsp;Paket Disita</a> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            demo.initChartsPages();
        });
    </script>
    <script>
        const chartMasuk = new Chart(document.getElementById('chartMasuk').getContext('2d'), {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Jumlah Masuk',
                    data: {!! json_encode($totals) !!},
                    fill: false,
                    borderColor: 'green',
                    backgroundColor: 'lightgreen',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        const chartKeluar = new Chart(document.getElementById('chartKeluar').getContext('2d'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels2) !!},
                datasets: [{
                    label: 'Jumlah Keluar',
                    data: {!! json_encode($totals2) !!},
                    fill: false,
                    borderColor: 'red',
                    backgroundColor: 'pink',
                    tension: 0.3
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        const toggleBtn = document.getElementById('toggleButton');
        const extraRows = document.querySelectorAll('.extra-row');
        let expanded = false;

        toggleBtn.addEventListener('click', () => {
            extraRows.forEach(row => row.classList.toggle('d-none'));
            toggleBtn.innerText = expanded ? 'Lihat Semua Data' : 'Tampilkan 5 Data';
            expanded = !expanded;
        });
    </script>
    </script>
@endpush
