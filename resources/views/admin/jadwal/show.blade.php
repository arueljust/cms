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
                                <h4><strong>Absensi</strong> <strong class="text-warning">Siswa</strong>
                                    <a href="{{ url('admin/jadwal') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong>Kembali</strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped table-bordered shadow">
                                    <thead>
                                        <form action="" action="GET">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <select name="kelas_id" class="form-select">
                                                        <option value=""> - Pilih Kelas - </option>
                                                        <option value="7" {{Request::get('kelas_id')=='kelas_id' ? 'selected':''}}>Usia-Dini</option>
                                                        <option value="8" {{Request::get('kelas_id')=='kelas_id' ? 'selected':''}}>Pra-Remaja</option>
                                                        <option value="9" {{Request::get('kelas_id')=='kelas_id' ? 'selected':''}}>Remaja(Rmj)</option>
                                                        <option value="10" {{Request::get('kelas_id')=='kelas_id' ? 'selected':''}}>Dewasa</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">

                                                    <button type="submit" class="btn btn-sm btn-warning text-dark shadow"><strong>Cari</strong></button>
                                                </div>
                                            </div>
                                            <hr>
                                            @foreach($dataSiswa as $ds)
                                            <tr>
                                                <td>{{ $ds->id }}</td>
                                                <td>{{ $ds->nama }}</td>
                                                <td>{{ $ds->kelas['kelas'] }}</td>
                                                <td><select name="" id="">
                                                        <option value="">Hadir</option>
                                                        <option value="">Alpha</option>
                                                        <option value="">Izin</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </form>
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
