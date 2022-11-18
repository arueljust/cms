@extends('admin.panel')
@section('title','Info')
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
                                <h4><strong>Edit</strong> <strong class="text-warning">Pengumuman</strong>
                                    <a href="{{ url('admin/info') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong> Kembali </strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/info/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>Hari / Tanggal :</label>
                                        <input type="date" name="tanggal" class="form-control shadow" value="{{$data->tanggal}}" required />
                                    </div>
                                    <div class="mb-3">
                                        <label>Waktu :</label>
                                        <input type="text" name="waktu" class="form-control shadow" placeholder="Masukkan waktu" value="{{$data->waktu}}" required>
                                        @error('waktu') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Judul :</label>
                                        <input type="text" name="judul" class="form-control shadow" placeholder="Masukkan judul" value="{{$data->judul}}" required>
                                        @error('judul') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Usia/Kelas :</label>
                                        <select class="form-control shadow" name="kelas_id" required>
                                            <option value="">-- Pilih Kelas Siswa --</option>
                                            @foreach($dataKelas as $d)
                                            <option value="{{ $d->id }}" {{$data->kelas_id== $d->id ? 'selected':''}}>{{$d->kelas}}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Deskripsi :</label>
                                        <textarea name="deskripsi" rows="2" class="form-control shadow" required>{{ $data->deskripsi }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label>Status :</label><br>
                                        <input type="checkbox" name="status" value="0" {{$data->status== '0' ? 'checked':''}}/> Sembunyikan
                                        <input type="checkbox" name="status" value="1" {{$data->status== '1' ? 'checked':''}}/> Perlihatkan
                                        @error('status') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
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

