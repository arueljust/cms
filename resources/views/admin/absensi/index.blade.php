@extends('admin.panel')
@section('title','absensi')
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
                                <h4><strong>Data</strong> <strong class="text-warning">Absensi</strong>
                                    <a href="{{ url('admin/absensi/create') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong>Tambah Data</strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped shadow" id="example1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Kelas</th>
                                            <th>Nama Siswa</th>
                                            <th>L/P</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach($dataJadwal as $ds)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$ds->tanggal}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
