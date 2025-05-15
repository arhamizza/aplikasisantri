@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'tabel',
])

@section('content')
<div class="content">
    <div class="card">
        <div class="card-body">
            <div class="class-header">
                <h3>Tambah Data</h3>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('insert-paket') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <h5>Paket</h5>
                                    <input class="form-control" name="nama_paket" placeholder="nama  paket">
                                </div>
                                <div class="form-group">
                                    <h5>Tanggal</h5>
                                    <input type="date" name="tanggal_diterima" id="tanggal_diterima" class="form-control"
                                        style="width: 100%; display: inline;" onchange="invoicedue(event);" required
                                        value="{{ old('started_at') }}">
                                </div>
                                <div class="form-group">
                                    <select class="form-select" name="kategori_paket">
                                        <option value>Pilih Kategori Paket</option>
                                        @foreach ($kategori as $item)
                                            <option value="{{ $item->id }}" class="bold">{{ $item->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-select" name="penerima_paket">
                                        <option value>Pilih Penerima Paket</option>
                                        @foreach ($santri as $item)
                                            <option value="{{ $item->nis }}" class="bold">{{ $item->nama_santri }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-select" name="asrama">
                                        <option value>Pilih asrama</option>
                                        @foreach ($asrama as $item)
                                            <option value="{{ $item->id }}" class="bold">{{ $item->nama_asrama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <h5>Alamat</h5>
                                    <input class="form-control" name="pengirim_paket" placeholder="Pengirim Paket">
                                </div>
                                <div class="form-group">
                                    <h5>Total paket yang diterima</h5>
                                    <input class="form-control" name="isi_paket_yang_disita" placeholder="isi paket yang disita">
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_paket" value="diambil">
                                    <h5>
                                      diambil
                                    </h5>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status_paket" value="belum_diambil" checked>
                                    <h5>
                                      belum diambil
                                    </h5>
                                  </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
