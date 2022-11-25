@extends('admin.panel')
@section('title','User')
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
                                <h4><strong>Data</strong> <strong class="text-warning">User</strong>
                                    <button type="button" id="addUser" class="btn btn-sm btn-outline-primary float-right d-none" data-bs-toggle="modal" data-bs-target="#staticBackdropUser">
                                        <strong>Tambah Data</strong>
                                    </button>
                                    <button type="button" id="deleteUser" class="btn btn-sm btn-outline-danger float-end mr-1 d-none">
                                        <strong>Hapus Data</strong>
                                    </button>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped shadow" id="user-table">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" name="main_checkbox"><label></label></th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Register</th>
                                            <th>Role</th>
                                            <th>Status</th>
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
<div class="modal fade" id="staticBackdropUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabelUser"><strong class="text-dark">Tambah Data</strong> <strong class="text-warning">User</strong></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST">
                    @csrf
                    <div>
                        <label>Nama :</label>
                        <div class="col-md-12">
                            <input id="nama" type="text" class="form-control" name="name" required autocomplete="name" autofocus>
                            <input type="hidden" id="id" name="id">
                        </div>
                    </div>
                    <div>
                        <label>Email :</label>
                        <div class="col-md-12">
                            <input id="email" type="text" class="form-control" name="email" required autocomplete="email" autofocus>
                        </div>
                    </div>
                    <div>
                        <label>Role :</label>
                        <div class="col-md-12">
                            <input id="role" type="text" class="form-control" name="role" required autocomplete="role" autofocus>
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

<input type="hidden" id="table-url" value="{{ route('indexUser') }}">
@endsection
@push('script')
<script src="{{ asset('js/user/main.js') }}"></script>
@endpush
