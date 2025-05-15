@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'santri',
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
            <h1>Daftar Nama Santri</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Addsantri">
                Add santri
            </button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#importsantri">
                Import Nama santri
            </button>
            {{-- <a href="{{ url('/santri/export_excel') }}" class="btn btn-primary btn-md" role="button"
                aria-disabled="true">Export Nama santri</a> --}}
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>nis</th>
                        <th>Nama santri</th>
                        <th>alamat</th>
                        <th>total paket yang diterima</th>
                        <th>asrama</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($santri as $sk)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $sk->nis }}</td>
                            <td>{{ $sk->nama_santri }}</td>
                            <td>{{ $sk->alamat }}</td>
                            <td>{{ $sk->total_paket_diterima }}</td>
                            <td>{{ $sk->asrama2->nama_asrama }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#Editsantri-{{ $sk->nis }}">
                                    <i class="fa-solid fa-pen-to-square fa-2xl"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#Deletesantri-{{ $sk->nis }}">
                                    <i class="fa-sharp fa-solid fa-trash fa-beat-fade fa-2xl"></i>
                                </button>
                            </td>
                        </tr>
                        @php $no++; @endphp
                    @endforeach
                </tbody>
            </table>
        </div>
    </div><!-- /.panel-->
    <!--/.main-->

    <!-- The Modal -->
    <div class="modal" id="Addsantri">
        <div class="modal-dialog">
            <div class="modal-content">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Nama santri</h4>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <form role="form" action="{{ url('santri_add') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>NIS</label>
                            <input class="form-control" name="nis" placeholder="nis">
                        </div>
                        <div class="form-group">
                            <label>Nama santri</label>
                            <input class="form-control" name="nama_santri" placeholder="Nama santri">
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <input class="form-control" name="alamat" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label>Total paket yang diterima</label>
                            <input class="form-control" name="total_paket_diterima" placeholder="total paket yang diterima">
                        </div>
                        <div class="form-group">
                            <select class="form-select" name="asrama">
                                <option value>Pilih asrama</option>
                                @foreach ($asrama as $item)
                                    <option value="{{ $item->id }}" class="bold">{{ $item->nama_asrama }}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- IMPORT -->
    <div class="modal fade" id="importsantri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="post" action="{{ url('santri_import_excel') }}" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                    </div>
                    <div class="modal-body">

                        {{ csrf_field() }}

                        <label>Pilih file excel</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control  @error('file') is-invalid @enderror" name="file">
                            @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        {{-- <div class="form-group">
                            <label>Gambar visualisasi</label>
                            <input type="file" name="visualisasi" class="file-upload-default" required="required"> 
                            <div class="input-group col-xs-12">
                                <input type="text" class="form-control file-upload-info" 
                                    placeholder="Upload Gambar">
                                <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary"
                                        type="button">Upload</button>
                                </span>
                            </div>
                        </div> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @foreach ($santri as $sk)
        <div class="modal" id="Editsantri-{{ $sk->nis }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Nama santri</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form role="form" action="{{ url('santri_update/' . $sk->nis) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama Santri</label>
                                <input type="text" value="{{ $sk->nama_santri }}" class="form-control"
                                    name="nama_santri" value="" placeholder="Masukkan Nama santri">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" value="{{ $sk->alamat }}" class="form-control" name="alamat"
                                    value="" placeholder="Masukkan Alamat">
                            </div>
                            <div class="form-group">
                                <label for="">Total Paket yang Diterima</label>
                                <input type="text" value="{{ $sk->total_paket_diterima }}" class="form-control"
                                    name="total_paket_diterima" value=""
                                    placeholder="Masukkan Total Paket yang Diterima">
                            </div>
                            <div class="form-group">
                                <select class="form-select" name="id_asrama">
                                    @foreach ($asrama as $kel)
                                        <option value="{{ $kel->id }}" {{ $kel->id == $sk->id ? 'selected' : '' }}>
                                            {{ $kel->nama_asrama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info">Update</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal" id="Deletesantri-{{ $sk->nis }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Delete Nama santri</h4>

                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <h5>Apakah Kamu Yakin Delete?</h5>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="{{ url('santri_delete/' . $sk->nis) }}" class="btn btn-info">Yes</a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
