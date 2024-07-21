<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;
    protected $table = 'rank';
    protected $guarded = [];

    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function paket(){
        return $this->hasMany(Paket::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
