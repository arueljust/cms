<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiUd extends Model
{
    use HasFactory;

    protected $table='absensi_ud';

    protected $guarded=['id'];
}
