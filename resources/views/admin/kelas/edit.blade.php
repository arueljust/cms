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
                                <h4><strong>Edit Data</strong> <strong class="text-warning">Kelas</strong>
                                    <a href="{{ url('admin/kelas') }}" class="btn btn-sm btn-outline-primary shadow float-right"><strong> Kembali </strong></a>
                                </h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ url('admin/kelas/'.$data->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label>Kelas :</label>
                                        <input type="text" name="kelas" class="form-control shadow" value="{{ $data->kelas }}" placeholder="Masukkan Kelas">
                                        @error('kelas') <small class="text-danger">{{$message}}</small> @enderror
                                    </div>
                                    <hr>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-sm btn-warning shadow float-right"><strong> Update </strong></button>
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
