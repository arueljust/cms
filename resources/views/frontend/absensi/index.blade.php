@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-outline card-warning">
                    <div class="card-header">
                        <h4>
                            <strong>Jadwal</strong>
                        </h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped" id="example">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Materi</th>
                                    <th>Nama Guru</th>
                                    <th>Kelas/Usia</th>
                                    <th>Waktu</th>

                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $i=1;
                                @endphp
                                @foreach($dataJadwal as $d)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{Carbon\Carbon::parse($d->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                                    <td><strong>{{ $d->materi }}</strong></td>
                                    <td>- {{ $d->guru['nama']}}</td>
                                    <td>{{ $d->kelas['kelas']}}</td>
                                    <td>{{ $d->waktu}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <br>
            <div class="card shadow">
                <div class="card-outline card-dark">
                    <div class="card-header">
                        <h4>
                            <strong class="text-warning">Absensi</strong>
                        </h4>
                    </div>

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
