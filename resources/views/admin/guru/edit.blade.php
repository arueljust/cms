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
                                <h4><strong>Edit Data</strong> <strong class="text-warning">Guru</strong>
                                    <a href="{{ url('admin/guru') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong> Kembali </strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/guru/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div>
                                        <label for="nama" class="col-md-4 col-form-label">Nama Guru :</label>
                                        <div class="col-md-12">
                                            <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror shadow" name="nama" value="{{ $data->nama }}" required autocomplete="nama" autofocus>
                                            @error('nama')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="alamat" class="col-md-4 col-form-label">Alamat :</label>
                                        <div class="col-md-12">
                                            <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror shadow" name="alamat" value="{{ $data->alamat }}" required autocomplete="alamat" autofocus>
                                            @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="ttl" class="col-md-4 col-form-label">Tempat/Tanggal/Lahir :</label>
                                        <div class="col-md-12">
                                            <input id="ttl" type="text" class="form-control @error('ttl') is-invalid @enderror shadow" name="ttl" value="{{ $data->ttl }}" required autocomplete="ttl" autofocus>
                                            @error('ttl')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="no_telp" class="col-md-4 col-form-label">No Telp :</label>
                                        <div class="col-md-12">
                                            <input id="no_telp" type="text" class="form-control @error('no_telp') is-invalid @enderror shadow" name="no_telp" value="{{ $data->no_telp }}" required autocomplete="no_telp" autofocus>
                                            @error('no_telp')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="col-md-4 col-form-label">Jenis Kelamin :</label>
                                        <div class="col-md-12">
                                            <select name="jenis_kelamin" class="form-control shadow" required>
                                                <option value="">-- Pilih Jenis Kelamin --</option>
                                                <option value="L" {{ $data->jenis_kelamin == 'L' ? 'selected':'' }}> Laki-Laki </option>
                                                <option value="P" {{ $data->jenis_kelamin == 'P' ? 'selected':'' }}> Perempuan </option>
                                            </select>
                                            @error('jenis_kelamin') <small class="text-danger">{{$message}}</small> @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="foto" class="col-md-4 col-form-label">Update Foto :</label>
                                        <div class="col-md-12">
                                            <input type="file" name="foto" class="form-control shadow" />
                                            <br>
                                            <img src="{{ asset('fotoguru/'.$data->foto)}}" alt="No Image" style="width: 80px; height: 80px;">
                                            @error('foto')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="sertifikat" class="col-md-4 col-form-label">Update Sertifikat (Ijazah MT) :</label>
                                        <div class="col-md-12">
                                            <input type="file" name="sertifikat" class="form-control shadow" />
                                            <br>
                                            <img src="{{ asset('sertifikatguru/'.$data->sertifikat)}}" alt="No Image" style="width: 80px; height: 80px;">
                                            @error('sertifikat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm btn-warning shadow float-right"><strong> Update </strong></button>
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
