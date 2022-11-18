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
                                <h4><strong>Detail Data</strong> <strong class="text-warning">Guru</strong>
                                    <a href="{{ url('admin/guru') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong>Kembali</strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered shadow">
                                    <thead>
                                        <tr class="text-center">
                                            <td class="circular-image">
                                                <img src="{{asset('fotoguru/'.$data->foto)}}" style="width:150px; height:150px" alt="Tidak ada gambar">
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>ID</th>
                                            <td>{{ $data->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nama Guru</th>
                                            <td>{{ $data->nama }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $data->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tempat / Tanggal / Lahir</th>
                                            <td>{{ $data->ttl }}</td>
                                        </tr>
                                        <tr>
                                            <th>NO. Telp</th>
                                            <td>{{ $data->no_telp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jenis Kelamin</th>
                                            @if($data->jenis_kelamin == 'P')
                                            <td>{{$data->jenis_kelamin == 'P' ? 'Perempuan':''}}</td>
                                            @else
                                            <td>{{$data->jenis_kelamin == 'P' ? '':'Laki-Laki'}}</td>
                                            @endif
                                        </tr>
                                        <tr>
                                            <th>Sertifikat (Ijazah MT)</th>
                                            <td>
                                                <img src="{{asset('sertifikatguru/'.$data->sertifikat)}}" style="width:80px; height:80px" alt="Tidak ada gambar">
                                            </td>
                                        </tr>
                                    </thead>
                                </table>
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
