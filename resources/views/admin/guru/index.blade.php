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
                                <h4><strong>Data</strong> <strong class="text-warning">Guru</strong>
                                    <button type="button" id="addGuru" class="btn btn-sm btn-outline-primary float-right" data-bs-toggle="modal" data-bs-target="#staticBackdropGuru">
                                        <strong>Tambah Data</strong>
                                    </button>
                                    <button type="button" id="deleteGuru" class="btn btn-sm btn-outline-danger float-end mr-1 d-none">
                                        <strong>Hapus Data</strong>
                                    </button>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped shadow" id="guru-table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="main_checkbox" ><label></label></th>
                                            <th>No</th>
                                            <!-- <th>Foto</th> -->
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <!-- <th>Tempat/Tanggal/Lahir</th> -->
                                            <th>No Telp</th>
                                            <!-- <th>Sertifikat</th> -->
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
<div class="modal fade" id="staticBackdropGuru" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabelGuru"><strong class="text-dark">Tambah Data</strong> <strong class="text-warning">Guru</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nama Guru :</label>
                            <input type="text" id="nama" name="nama" class="form-control shadow" placeholder="Nama Guru">
                            <input type="hidden" id="id" name="id">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Alamat :</label>
                            <input type="text" id="alamat" name="alamat" class="form-control shadow" placeholder="Alamat">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Tempat /Tanggal /Lahir :</label>
                            <input type="text" id="ttl" name="ttl" class="form-control shadow" placeholder="Tempat-Tanggal-Lahir">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label>No Telp :</label>
                            <input type="text" id="no_telp" name="no_telp" class="form-control shadow" placeholder="Nomer telpon">

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
                        <div class="col-md-6 mb-3">
                            <label>Upload (Ijazah MT) :</label>
                            <input type="file" id="sertifikat" name="sertifikat" class="form-control shadow" />

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

<input type="hidden" id="table-url" value="{{ route('indexGuru') }}">
@endsection
@push('script')

<script src="{{ asset('js/guru/main.js') }}"></script>

@endpush
