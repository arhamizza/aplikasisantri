@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'setting',
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

        <body>
            <h1>Backup & Restore Database</h1>
        
            @if(session('success'))
                <div style="color: green;">{{ session('success') }}</div>
            @endif
        
            @if(session('error'))
                <div style="color: red;">{{ session('error') }}</div>
            @endif
        
            <form method="POST" action="{{ route('backup.run') }}">
                @csrf
                <button type="submit">Backup Database</button>
            </form>
        
            <br>
        
            <form method="POST" action="{{ route('backup.restore') }}" enctype="multipart/form-data">
                @csrf
                <label>Pilih File SQL untuk Restore:</label>
                <input type="file" name="backup_file" required>
                <button type="submit">Restore Database</button>
            </form>
        
            <hr>

@endsection
