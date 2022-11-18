<?php

namespace App\Models;

use App\Models\Guru;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jadwal extends Model
{
    use HasFactory;

    protected $table='jadwals';

    protected $fillable=[
        'tanggal',
        'materi',
        'gurus_id',
        'kelas_id',
        'waktu',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class,'gurus_id','id');
    }

}
