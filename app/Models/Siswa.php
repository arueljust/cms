<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table='siswas';

    protected $fillable=[
        'foto',
        'nama',
        'alamat',
        'ttl',
        'no_telp',
        'nama_ortu',
        'kelas',
        'jenis_kelamin',
        'kelas_id',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
