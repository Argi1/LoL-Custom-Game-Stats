<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MatchHistory extends Model
{
    protected $fillable = [
        'match_id',
        'game_time',
        'ban1',
        'ban2',
        'ban3',
        'ban4',
        'ban5',
        'ban6',
        'ban7',
        'ban8',
        'ban9',
        'ban10',
    ];
    protected $primaryKey = 'match_id';
    protected $table = 'match_history';

    public function summonerMatches()
    {
        return $this->hasMany(SummonerMatch::class, 'match_id');
    }
}