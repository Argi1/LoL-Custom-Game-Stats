<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class SummonerMatch extends Model
{
    protected $fillable = [
        'summoner_match_id',
        'summoner_id',
        'champion_id',
        'kills',
        'deaths',
        'assists',
        'level',
        'role',
        'didWin',
        'match_id',
        'team',
        'farm',
        'game_date'
    ];

    protected $primaryKey = 'summoner_match_id';
    protected $table = 'summoner_match';

    public function match()
    {
        return $this->belongsTo(MatchHistory::class, 'match_id');
    }
    
    public function summoner(){
        return $this->belongsTo(Summoner::class, 'summoner_id');
    }

    public function champion(){
        return $this->belongsTo(Champion::class, 'champion_id');
    }
}