@extends('admin.panel')
@section('title','Guru')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @if(session('message'))
            <div class="alert alert-success">{{session('message')}}</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h4><strong>Tambah Data</strong> <strong class="text-warning">Guru</strong>
                                    <a href="{{ url('admin/guru') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong> Kembali </strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/guru') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Nama Guru :</label>
                                        <input type="text" name="nama" class="form-control shadow" placeholder="Masukkan Nama Guru">
                                        @error('nama') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Alamat :</label>
                                        <input type="text" name="alamat" class="form-control shadow" placeholder="Masukkan Alamat">
                                        @error('alamat') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Tempat /Tanggal /Lahir :</label>
                                        <input type="text" name="ttl" class="form-control shadow" placeholder="Tempat-Tanggal-Lahir">
                                        @error('ttl') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>No Telp :</label>
                                        <input type="text" name="no_telp" class="form-control shadow" placeholder="Nomer telpon">
                                        @error('no_telp') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label><strong>Jenis Kelamin :</strong></label>
                                        <select name="jenis_kelamin" class="form-control shadow" required>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="L"> Laki-Laki </option>
                                            <option value="P"> Perempuan </option>
                                        </select>
                                        @error('jenis_kelamin') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Upload Foto :</label>
                                        <input type="file" name="foto" class="form-control shadow" />
                                        @error('foto') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Upload Sertifikat (Ijazah MT) :</label>
                                        <input type="file" name="sertifikat" class="form-control shadow" />
                                        @error('sertifikat') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-warning shadow float-right"><strong> Simpan </strong></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>
@endsection
