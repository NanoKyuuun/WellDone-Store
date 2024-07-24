<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Rank extends Model
{
    use HasFactory, HasSlug;
    protected $table = 'rank';
    protected $guarded = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
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
