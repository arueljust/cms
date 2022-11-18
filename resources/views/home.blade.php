@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-outline card-warning">
                    <div class="card-header">
                        <h4>
                            <strong>Pengumuman</strong>
                        </h4>
                    </div>
                    @foreach($data as $d)
                    @if($d->status==1)
                    <div class="card-body">
                        <div class="float-right">
                            <h6><strong>
                                @php
                                $waktu_posting = ($d->updated_at);

                                $waktu_sekarang = time();

                                $selisih = $waktu_sekarang - strtotime($waktu_posting);


                                if ($selisih < 60) { echo round($selisih)." detik yang lalu"; }
                                elseif($selisih < (60*60)){ echo round(($selisih/60))." menit yang lalu"; }
                                elseif($selisih < (60*60*24)){ echo round(($selisih/(60*60)))." jam yang lalu"; }
                                elseif($selisih < (60*60*24*3)){ echo round(($selisih/(60*60*24)))." hari yang lalu"; }
                                else{
                                    echo Carbon\carbon::parse($d->updated_at)->isoFormat('dddd, D MMM Y');
                                 }
                                @endphp

                                </strong>
                            </h6>
                        </div>
                        <tr>
                            <th><strong>Tanggal : </strong></th>
                            <td>{{Carbon\Carbon::parse($d->tanggal)->isoFormat('dddd, D MMMM Y') }}</td>
                        </tr><br>
                        <tr>
                            <th><strong>Judul : </strong></th>
                            <td>{{ $d->judul }}</td>
                        </tr><br>
                        <tr>
                            <th><strong>Waktu : </strong></th>
                            <td>{{ $d->waktu }}</td>
                        </tr><br>
                        <tr>
                            <th><strong>Kelas / Usia : </strong></th>
                            <td>{{ $d->kelas['kelas'] }}</td>
                        </tr>
                        <br>
                        <br>
                        <tr>
                            <th><strong>Deskripsi : </strong></th><br>

                            <td>{{ $d->deskripsi }}</td>
                        </tr>
                        <br>
                        <br>

                        <div>
                            <h6 class="float-right"><strong>Posted By : {{$d->user['name']}}</strong> </h6>
                        </div>
                        <hr>


                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
