<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $table = 'games';
    protected $guarded = [];

    public function rank(){
        return $this->hasMany(Rank::class);
    }
    public function worker(){
        return $this->hasMany(Worker::class);
    }
}
