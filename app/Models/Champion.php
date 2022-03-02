<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    protected $fillable = [
        'champion_id',
        'name'
    ];
    public $timestamps = false;
    protected $primaryKey = 'champion_id';
    
    public function championMatches()
    {
        return $this->hasMany(SummonerMatch::class, 'champion_id');
    }
}