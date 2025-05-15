@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'paket',
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
            <h1>Daftar Nama paket</h1>
            <a href="{{ url('tambah-paket')}}" class="btn btn-primary">Add Paket</a>
            {{-- <a href="{{ url('/paket/export_excel') }}" class="btn btn-primary btn-md" role="button"
                aria-disabled="true">Export Nama paket</a> --}}
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($paket as $sk)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $sk->nama_paket }}</td>
                            <td>{{ $sk->tanggal_diterima }}</td>
                            <td>{{ $sk->kategori->nama_kategori}}</td>
                            <td>{{ $sk->santri->nama_santri }}</td>
                            <td>{{ $sk->santri->asrama2->nama_asrama }}</td>
                            <td>{{ $sk->pengirim_paket }}</td>
                            <td>{{ $sk->isi_paket_yang_disita }}</td>
                            <td>{{ $sk->status_paket }}</td>
                            <td>
                                
                                <a href="{{ url('edit-paket/'.$sk->id)}}" class="btn btn-primary"><i class="fa-solid fa-pen-to-square fa-2xl"></i></a>
                                <a href="{{ url('hapus-paket/'.$sk->id)}}" class="btn btn-primary"><i class="fa-sharp fa-solid fa-trash fa-beat-fade fa-2xl"></i></a href="">
                            </td>

                        </tr>
                        @php $no++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- /.panel-->
    <!--/.main-->

@endsection
