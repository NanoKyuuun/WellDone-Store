<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Game extends Model
{
    use HasFactory,HasSlug;
    protected $table = 'games';
    protected $guarded = [];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function rank(){
        return $this->hasMany(Rank::class);
    }
    public function worker(){
        return $this->hasMany(Worker::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
