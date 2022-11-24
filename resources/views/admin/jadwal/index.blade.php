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
                                <h4><strong>Jadwal</strong> <strong class="text-warning">Pengajian</strong>
                                    <button type="button" id="addJadwal" class="btn btn-sm btn-outline-primary float-right" data-bs-toggle="modal" data-bs-target="#staticBackdropJadwal">
                                        <strong>Tambah Data</strong>
                                    </button>
                                    <button type="button" id="deleteJadwal" class="btn btn-sm btn-outline-danger float-end mr-1 d-none">
                                        <strong>Hapus Data</strong>
                                    </button>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped shadow" id="jadwal-table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="main_checkbox"><label></label></th>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Materi</th>
                                            <th>Nama Guru</th>
                                            <th>Kelas/Usia</th>
                                            <th>Waktu</th>
                                            <th>Absensi</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdropJadwal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabelJadwal"><strong class="text-dark">Tambah Data</strong> <strong class="text-warning">Jadwal</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Hari / Tanggal :</label>
                            <input type="date" id="tanggal" name="tanggal" class="form-control shadow" required />
                            <input type="hidden" id="id" name="id">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Materi :</label>
                            <input type="text" id="materi" name="materi" class="form-control shadow" placeholder="Masukkan materi" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nama Guru  :</label>
                            <select class="form-control shadow" id="gurus_id" name="gurus_id" required>
                                <option value="">-- Pilih Guru Pengajar --</option>
                                @foreach($dataGuru as $d)
                                <option value="{{$d->id}}">{{$d->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Waktu  :</label>
                            <input type="text" id="waktu" name="waktu" class="form-control shadow" placeholder="Masukkan waktu" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Usia/Kelas :</label>
                            <select class="form-control shadow" id="kelas_id" name="kelas_id" required>
                                <option value="">-- Pilih Kelas Siswa --</option>
                                @foreach($dataKelas as $d)
                                <option value="{{ $d->id }}">{{$d->kelas}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" id="close" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="save" class="btn btn-sm btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</div>


<input type="hidden" id="table-url" value="{{ route('indexJadwal') }}">
@endsection
@push('script')
<script src="{{ asset('js/jadwal/main.js') }}"></script>
@endpush
