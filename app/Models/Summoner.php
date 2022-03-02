<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Summoner extends Model
{
    protected $fillable = [
        'summoner_id',
        'name',
        'total_kills',
        'total_deaths',
        'total_assists'
    ];
    public $timestamps = false;
    protected $primaryKey = 'summoner_id';
    
    public function summonerMatches()
    {
        return $this->hasMany(SummonerMatch::class, 'summoner_id');
    }
}