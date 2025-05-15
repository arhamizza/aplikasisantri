@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'laporan',
])

@section('content')
    <!-- content -->
    <div class="content">
        <!--/.row-v class="col-lg-12">
                                    <h1 class="page-header">List users</h1>
                                </div>
                            </div> --}}
                            <!--/.row-->
        {{-- notifikasi form validasi --}}
        @if ($errors->has('file'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
        @endif

        {{-- notifikasi sukses --}}
        @if ($sukses = Session::get('sukses'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $sukses }}</strong>
            </div>
        @endif

        @if ($message = Session::get('success'))
            <div class="alert bg-success" role="alert">
                <em class="fa fa-lg fa-check">&nbsp;</em>
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="alert bg-danger" role="alert">
                <em class="fa fa-lg fa-check">&nbsp;</em>
                {{ $message }}
            </div>
        @endif

        <div class="content">
            <h3>Data Keluar</h3>
            <form  class="pb-3" method="GET" action="{{ url('laporan_admin2') }}">
                <input type="date" name="start_date" value="{{ request('start_date') }}">
                <input type="date" name="end_date" value="{{ request('end_date') }}">
                <button type="submit">Filter</button>
            </form>
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Tanggal Diterima</th>
                        <th>Kategori</th>
                        <th>Isi paket yang disita</th>
                        <th>Status Paket</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($paket as $sk)
                    @if ($sk->status_paket == "belum_diambil" )
                    <tr>
                        <td>{{ $no }}</td>
                        <td>{{ $sk->nama_paket }}</td>
                        <td>{{ $sk->tanggal_diterima }}</td>
                        <td>{{ $sk->kategori->nama_kategori }}</td>
                        <td>{{ $sk->isi_paket_yang_disita }}</td>
                        <td>{{ $sk->status_paket }}</td>
                    </tr>
                    @php $no++; @endphp           
                    @endif

                    @endforeach
                </tbody>
            </table>
        </div>
      
@endsection
