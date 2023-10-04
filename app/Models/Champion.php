<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'champion_id',
        'name'
    ];
    protected $primaryKey = 'champion_id';

    public function championMatches()
    {
        return $this->hasMany(SummonerMatch::class, 'champion_id');
    }

    public function getChampionImgName()
    {
        if ($this->name == 'Wukong') {
            return 'MonkeyKing';
        }
        if ($this->name == 'Nunu & Willump') {
            return 'Nunu';
        }
        if ($this->name == 'Renata Glasc') {
            return 'Renata';
        }
        $name = preg_replace('/\s+/', '', $this->name);
        $name = preg_replace('/\'+/', '', $name);
        $name = preg_replace('/\.+/', '', $name);
        return $name;
    }
}
