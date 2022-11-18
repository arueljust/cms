@extends('admin.panel')
@section('title','User')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                            <h4><strong>Edit Data</strong> <strong class="text-warning">User</strong>
                                <a href="{{ url('admin/user') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong>Kembali</strong></a>
                            </h4>
                            </div>
                            <form method="POST" action="{{ url('admin/user/'.$data->id) }}">
                                <div class="card-body">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="nama" class="col-md-4 col-form-label">Nama :</label>

                                        <div class="col-md-12">
                                            <input id="nama" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $data->name }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="email" class="col-md-4 col-form-label">Email :</label>

                                        <div class="col-md-12">
                                            <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $data->email }}" required autocomplete="email" autofocus>

                                            @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="role" class="col-md-4 col-form-label">Role :</label>

                                        <div class="col-md-12">
                                            <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ $data->role }}" required autocomplete="role" autofocus>

                                            @error('role')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="password" class="col-md-4 col-form-label">Password :</label>

                                        <div class="col-md-12">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autofocus>

                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <br>

                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-warning  shadow "><strong>Save</strong></button>
                                    </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection
