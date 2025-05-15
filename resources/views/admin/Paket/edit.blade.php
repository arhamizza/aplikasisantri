@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'paket',
])

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-body">
                <div class="class-header">
                    <h3>edit Data Paket</h3>
                </div>
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ url('update-paket/'.$paket->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    <div class="form-group">
                                        <label for="">A</label>
                                        <input type="text" value="{{ $paket->nama_paket }}" class="form-control"
                                            name="nama_paket" value="" placeholder="Masukkan A">
                                    </div>
                                    <div class="form-group">
                                        <h5>Tanggal</h5>
                                        <input type="date" name="tanggal_diterima" id="tanggal_diterima"
                                            class="form-control" style="width: 100%; display: inline;"
                                            onchange="invoicedue(event);" required value="{{ old('started_at') }}">
                                    </div>
                                    <div>
                                        <h5> Pilih Kategori</h5>
                                        <select class="form-control" id="type" name="kategori_paket">
                                            @foreach ($kategori as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $user->kategori_paket == $paket->id ? 'selected' : '' }}>
                                                    {{ $user->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <h5> Pilih Penerima Paket</h5>
                                        <select class="form-control" id="type" name="penerima_paket">
                                            @foreach ($santri as $user)
                                                <option value="{{ $user->nis }}"
                                                    {{ $user->nama_paket == $paket->id ? 'selected' : '' }}>
                                                    {{ $user->nama_santri }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <h5 for="">Pengirim Paket</h5>
                                        <input type="text" value="{{ $paket->santri->nama_santri }}" class="form-control"
                                            name="pengirim_paket" value="" placeholder="Masukkan Nama Santri">
                                    </div>
                                    <div class="form-group">
                                        <h5 for="">Isi Paket Yang Disita</h5>
                                        <input type="text" value="{{ $paket->santri->nama_santri }}" class="form-control"
                                            name="isi_paket_yang_disita" value="" placeholder="Masukkan Nama Santri">
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
                                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
