@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'usermanagement',
])

@section('content')
    <!-- content -->
    <div class="content">
        <!--/.row-v class="col-lg-12">
                        <h1 class="page-header">List users</h1>
                    </div>
                </div> --}}
                <!--/.row-->

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
            <h1>User Management</h1>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Addusers">
                Add users
            </button>
            <table id="example" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username </th>
                        <th>role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $no }}</td>
                            <td>{{ $user->nama_user }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->role2->nama_role }}</td>
                            <td>
                                <button class="btn btn-info btn-sm" data-toggle="modal"
                                    data-target="#Edituser-{{ $user->id }}">
                                    <i class="fa-solid fa-pen-to-square fa-2xl"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" data-toggle="modal"
                                    data-target="#Deleteuser-{{ $user->id }}">
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
    <div class="modal" id="Addusers">
        <div class="modal-dialog">
            <div class="modal-content">
                @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add New user</h4>
                </div>


                <!-- Modal body -->
                <div class="modal-body">
                    <form role="form" action="{{ url('usermanagement_add') }}" method="POST">
                        @csrf
                        {{-- <div class="form-group">
                            <label>ID</label>
                            <input class="form-control" name="id" placeholder="Samakan dengan id_guru">
                        </div> --}}
                        <div class="form-group">
                            <label>Nama</label>
                            <input class="form-control" name="nama_user" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <select class="form-select" name="role">
                                <label>Role</label>
                                @foreach ($role as $item)
                                    <option value="{{ $item->id }}" class="bold">{{ $item->nama_role }}</option>
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

    @foreach ($users as $vd)
        <div class="modal" id="Edituser-{{ $vd->id }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Edit user</h4>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form role="form" action="{{ url('usermanagement_update/' . $vd->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Nama User</label>
                                <input type="text" value="{{ $vd->nama_user }}" class="form-control" name="nama_user"
                                    value="" placeholder="Masukkan Nama">
                            </div>
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" value="{{ $vd->username }}" class="form-control" name="username"
                                    value="" placeholder="Masukkan Username">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="text" value="" class="form-control" name="password" value=""
                                    placeholder="Masukkan Password">
                            </div>

                            <div class="form-group">
                                <select class="form-select" name="role">
                                    <label>Role</label>
                                    @foreach ($role as $item)
                                        <option value="{{ $item->id }}" class="bold">{{ $item->nama_role }}</option>
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

        <div class="modal" id="Deleteuser-{{ $vd->id }}">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Delete user</h4>

                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <h5>Apakah Kamu Yakin Delete?</h5>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <a href="{{ url('usermanagement_delete/' . $vd->id) }}" class="btn btn-info">Yes</a>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
