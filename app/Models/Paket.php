<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;

    protected $table = 'pakets';
    protected $guarded = [];

    public function rank(){
        return $this->belongsTo(Rank::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
