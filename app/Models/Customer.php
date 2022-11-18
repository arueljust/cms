<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table='customers';

    protected $guarded=[];

    public function bankData()
    {
        return $this->hasMany(Bank::class,'bank_id','id');
    }
}
