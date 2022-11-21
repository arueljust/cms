@extends('admin.panel')

@section('title','Kelas')

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
                                <h4><strong>Data</strong> <strong class="text-warning">Kelas</strong>
                                    <button type="button" id="addKelas" class="btn btn-sm btn-outline-primary float-right" data-bs-toggle="modal" data-bs-target="#staticBackdropKelas">
                                        <strong>Tambah Data</strong>
                                    </button>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped shadow" id="kelas-table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kelas</th>
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
<div class="modal fade" id="staticBackdropKelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabelKelas"><strong class="text-dark">Tambah Data</strong> <strong class="text-warning">Siswa</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form method="POST">
                    @csrf
                    <div class="mb-3">
                        <label>Kelas :</label>
                        <input type="text" id="kelas" name="kelas" class="form-control shadow" placeholder="Masukkan Kelas">
                        <input type="hidden" id="id" name="id">
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

<input type="hidden" id="tableKelas-url" value="{{ route('indexKelas') }}">

@endsection
@push('script')

<script src="{{ asset('js/kelas/main.js') }}"></script>

@endpush
