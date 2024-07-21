<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function game(){
        return $this->belongsTo(Game::class);
    }

    public function rank(){
        return $this->belongsTo(Rank::class);
    }

    public function paket(){
        return $this->belongsTo(Paket::class);
    }
}
