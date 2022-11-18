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
                                <h4><strong>Edit</strong> <strong class="text-warning">Jadwal</strong>
                                    <a href="{{ url('admin/jadwal') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong> Kembali </strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/jadwal/'.$dataJadwal->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="tanggal" class="col-md-4 col-form-label">Hari / Tanggal :</label>
                                        <div class="col-md-12">
                                            <input id="tanggal" type="date" class="form-control @error('tanggal') is-invalid @enderror shadow" name="tanggal" value="{{ $dataJadwal->tanggal }}" required autofocus>
                                            @error('tanggal')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>Materi 1 :</label>
                                        <input type="text" name="materi" class="form-control shadow" value="{{ $dataJadwal->materi }}">
                                        @error('materi') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Nama Guru 1 :</label>
                                        <select class="form-control shadow" name="gurus_id" required>
                                            <option value="">-- Pilih Guru Pengajar --</option>
                                            @foreach ($dataGuru as $dg)
                                            <option value="{{ $dg->id }}" {{ $dataJadwal->gurus_id == $dg->id ? 'selected':''}}>{{ $dg->nama }}</option>
                                            @endforeach

                                        </select>
                                        @error('gurus_id') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Usia/Kelas :</label>
                                        <select class="form-control shadow" name="kelas_id" required>
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach($dataKelas as $dk)
                                            <option value="{{ $dk->id}}" {{ $dataJadwal->kelas_id == $dk->id ? 'selected':'' }}>{{ $dk->kelas}}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label>Waktu :</label>
                                        <input type="text" name="waktu" class="form-control shadow" value="{{ $dataJadwal->waktu }}">
                                        @error('waktu') <small class="text-danger">{{$message}}</small> @enderror
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
