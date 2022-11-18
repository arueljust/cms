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
                                <h4><strong>Info</strong> / <strong class="text-warning">Pengumuman</strong>
                                    <a href="{{ url('admin/info/create') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong>Buat Pengumuman</strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped shadow" id="example1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Judul</th>
                                            <th>Kelas / Usia</th>
                                            <th>Deskripsi</th>
                                            <th>Status</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach($data as $d)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{Carbon\Carbon::parse($d->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                                            <td>{{$d->waktu}}</td>
                                            <td>{{$d->judul}}</td>
                                            <td>{{$d->kelas['kelas']}}</td>
                                            <td>{{$d->deskripsi}}</td>
                                            <td>
                                                @if($d->status== 1)
                                                <span class="badge badge-success">
                                                    {{ $d->status == '1' ? 'Aktif':'' }}
                                                </span>
                                                @else
                                                <span class="badge badge-danger">
                                                    {{ $d->status == '0' ? 'Non-Aktif':'' }}
                                                </span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url ('/admin/info/edit/'. $d->id)}} " class="btn btn-sm btn-outline-success shadow">
                                                    <i class="bi bi-pencil-square"></i> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                    </svg></a> |

                                                <a href="{{url('/admin/info/delete/'. $d->id)}}" onclick="return confirm('Yakin Hapus Data?')" class="btn btn-sm btn-outline-danger shadow">
                                                    <i class="bi bi-trash"></i> <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg> </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                   </tbody>
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
