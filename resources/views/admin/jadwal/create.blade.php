@extends('admin.panel')
@section('title','Jadwal')
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
                                <h4><strong>Tambah Jadwal</strong> <strong class="text-warning">Pengajian</strong>
                                    <a href="{{ url('admin/jadwal') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong> Kembali </strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/jadwal') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label>Hari / Tanggal :</label>
                                        <input type="date" name="tanggal" class="form-control shadow" required/>
                                    </div>
                                    <div class="mb-3">
                                        <label>Materi 1 :</label>
                                        <input type="text" name="materi[]" class="form-control shadow" placeholder="Masukkan materi" required>
                                        @error('materi') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Guru 1 :</label>
                                        <select class="form-control shadow" name="gurus_id[]" required>
                                            <option value="">-- Pilih Guru Pengajar --</option>
                                            @foreach($dataGuru as $d)
                                            <option value="{{$d->id}}">{{$d->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('gurus_id') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Waktu :</label>
                                        <input type="text" name="waktu[]" class="form-control shadow" placeholder="Masukkan waktu" required>
                                        @error('waktu') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Materi 2 :</label>
                                        <input type="text" name="materi[]" class="form-control shadow" placeholder="Masukkan materi">
                                        @error('materi') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Guru 2 :</label>
                                        <select class="form-control shadow" name="gurus_id[]" >
                                            <option value="">-- Pilih Guru Pengajar --</option>
                                            @foreach($dataGuru as $d)
                                            <option value="{{$d->id}}">{{$d->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('gurus_id') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Waktu :</label>
                                        <input type="text" name="waktu[]" class="form-control shadow" placeholder="Masukkan waktu">
                                        @error('waktu') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Materi 3 :</label>
                                        <input type="text" name="materi[]" class="form-control shadow" placeholder="Masukkan materi">
                                        @error('materi') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Guru 3 :</label>
                                        <select class="form-control shadow" name="gurus_id[]" >
                                            <option value="">-- Pilih Guru Pengajar --</option>
                                            @foreach($dataGuru as $d)
                                            <option value="{{$d->id}}">{{$d->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('gurus_id') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Waktu :</label>
                                        <input type="text" name="waktu[]" class="form-control shadow" placeholder="Masukkan waktu">
                                        @error('waktu') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Usia/Kelas :</label>
                                        <select class="form-control shadow" name="kelas_id" required>
                                            <option value="">-- Pilih Kelas Siswa --</option>
                                            @foreach($dataKelas as $d)
                                            <option value="{{ $d->id }}">{{$d->kelas}}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id') <small class="text-danger">{{$message}}</small> @enderror
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
