<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $table='gurus';

    protected $fillable=[
        'foto',
        'nama',
        'alamat',
        'ttl',
        'no_telp',
        'sertifikat',
        'jenis_kelamin',
    ];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

}
