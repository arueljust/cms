@extends('admin.panel')

@section('title','Siswa')

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

                                <h4><strong>Data</strong> <strong class="text-warning">Siswa</strong>
                                    <!-- Button trigger modal -->
                                    <button type="button" id="tambah" class="btn btn-sm btn-outline-primary float-right" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <strong>Tambah Data</strong>
                                    </button>
                                    <button type="button" id="delete" class="btn btn-sm btn-outline-danger float-end mr-1 d-none">
                                        <strong>Hapus Data</strong>
                                    </button>
                                </h4>
                            </div>

                            <div class="card-body">
                                <table class="table table-bordered table-striped shadow" id="siswa-table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="main_checkbox"><label></label></th>
                                            <th>No</th>
                                            <!-- <th>Foto</th> -->
                                            <th>Nama</th>
                                            <th>Tempat/Tanggal/Lahir</th>
                                            <th>No Telp</th>
                                            <th>Nama Ortu</th>
                                            <th>Kelas/Usia</th>
                                            <th>L/P</th>
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
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel"><strong class="text-dark">Tambah Data</strong> <strong class="text-warning">Siswa</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Siswa :</label>
                            <input type="text" id="nama" name="nama" class="form-control shadow" placeholder="Nama Lengkap Siswa">
                            <input type="hidden" id="id" name="id">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Alamat :</label>
                            <input type="text" id="alamat" name="alamat" class="form-control shadow" placeholder="Alamat">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tempat / Tanggal /Lahir :</label>
                            <input type="text" id="ttl" name="ttl" class="form-control shadow" placeholder="Tempat-Tanggal-Lahir">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>No Telp :</label>
                            <input type="text" id="no_telp" name="no_telp" class="form-control shadow" placeholder="Nomer telpon">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Nama Ortu :</label>
                            <input type="text" id="nama_ortu" name="nama_ortu" class="form-control shadow" placeholder="Nama Orang Tua">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label><strong>Kelas / Usia :</strong></label>
                            <select id="kelas_id" name="kelas_id" class="form-control shadow" required>
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($data as $d)
                                <option value="{{ $d->id }}">{{ $d->kelas }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label><strong>Jenis Kelamin :</strong></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control shadow" required>
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="L"> Laki-Laki </option>
                                <option value="P"> Perempuan </option>
                            </select>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Upload Foto :</label>
                            <input type="file" id="foto" name="foto" class="form-control shadow" />

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

<input type="hidden" id="table-url" value="{{ route('index') }}">

@endsection
@push('script')

<script src="{{ asset('js/siswa/main.js') }}"></script>

@endpush
