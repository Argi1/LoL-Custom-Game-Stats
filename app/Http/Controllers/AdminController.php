<?php

namespace App\Http\Controllers;

use DateTime;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Champion;
use App\Models\Summoner;
use App\Models\SummonerMatch;
use App\Models\MatchHistory;
use App\Extensions\ReplaybookDataConvert;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function showChampionUpdate()
    {
        return view('admin.championUpdate');
    }

    public function updateChampionList()
    {
        $versions = file_get_contents('https://ddragon.leagueoflegends.com/api/versions.json');
        $versions = json_decode($versions, true);
        $latest = $versions['0'];
        $json = file_get_contents('https://ddragon.leagueoflegends.com/cdn/'.$latest.'/data/en_US/champion.json');
        $json = json_decode($json, true);

        $data = $json["data"];

        foreach($data as $champ){
            $champModel = Champion::firstOrCreate(
                ['champion_id' => $champ["key"]],
                ['name' => $champ["name"]]
            );
        }
        $champModel = Champion::firstOrCreate(
            ['champion_id' => 0],
            ['name' => 'No Ban']
        );

        return view('admin.championUpdate');
    }

    public function showGame()
    {
        $championList = Champion::all();
        return view('admin.game', ['championList' => $championList]);
    }

    public function addGame(Request $request)
    {
        if ($request->is('admin/*')) {
            
            $replay = $request->file('replay');
            $bans = $request->except('_token', 'replay');
            
            $replayData = json_decode($replay->get(), true);
            
            if(MatchHistory::firstWhere('match_id', $replayData['matchId']) == null){

                self::createMatch($replayData['matchId'], $replayData['gameDuration'], $bans);
                
                foreach($replayData['participants'] as $key => $participant){

                    $summoner = self::updateSummoner($participant["name"],$participant["championsKilled"], $participant["numDeaths"], $participant["assists"]);

                    $championId = ReplaybookDataConvert::convertChampionName($participant["skin"]);
                    if($championId == null){
                        $championId = Champion::select('champion_id')->firstWhere('name', $participant["skin"])->champion_id;
                    }

                    self::createSummonerMatch($participant, $championId, $summoner['summoner_id'], $replayData['matchId'], $key);
                }
            }
            else{
                Log::debug('game exists');
            }
            return redirect('admin/game');
        }
        return redirect('login');
    }

    //Create a new match in MatchHistory table and fill it with data
    public function createMatch($matchId, $matchDuration, $bans){
        $match = new MatchHistory();
        $match->match_id = $matchId;

        $match->game_time = gmdate("H:i:s", $matchDuration / 1000);

        $banList = array();

        foreach($bans as $ban){
            $championId = ReplaybookDataConvert::convertChampionName($ban);

            if($championId == 0){
                $championId = Champion::select('champion_id')->firstWhere('name', $ban)->champion_id;
            }

            array_push($banList, $championId);
        }

        $match->ban1 = $banList[0];
        $match->ban2 = $banList[1];
        $match->ban3 = $banList[2];
        $match->ban4 = $banList[3];
        $match->ban5 = $banList[4];
        $match->ban6 = $banList[5];
        $match->ban7 = $banList[6];
        $match->ban8 = $banList[7];
        $match->ban9 = $banList[8];
        $match->ban10 = $banList[9];

        $match->save();
    }

    // Check if summoner exists in Summoners table.
    // Create new summoner if dosent exist.
    // Return newly created Summoner or the found Summoner.
    public function createNewSummonerIfDoesNotExist($name){
        $summoner = Summoner::firstOrNew(
            ['name' => $name],
            ['total_kills' => 0, 'total_deaths'=> 0, 'total_assists' => 0]
        );

        return $summoner;
    }

    // Get the summoner by name or create new one, then add the new matches stats to that summoner.
    // Return updated summoner
    public function updateSummoner($name, $kills, $deaths, $assists){
        $summoner = self::createNewSummonerIfDoesNotExist($name);

        $summoner->total_kills = $summoner->total_kills + $kills;
        $summoner->total_deaths = $summoner->total_deaths + $deaths;
        $summoner->total_assists = $summoner->total_assists + $assists;
        $summoner->save();
        
        return $summoner;
    }

    public function createSummonerMatch($participant, $championId, $summonerId, $matchId, $currentParticipantKey){
        $summonerMatch = new SummonerMatch();

        $summonerMatch->summoner_id = $summonerId;
        $summonerMatch->champion_id = $championId;
        $summonerMatch->kills = $participant['championsKilled'];
        $summonerMatch->deaths = $participant['numDeaths'];
        $summonerMatch->assists = $participant['assists'];
        $summonerMatch->level = $participant['level'];
        $summonerMatch->farm = $participant['minionsKilled'] + $participant['neutralMinionsKilled'];
        $summonerMatch->role = ReplaybookDataConvert::convertRoleNames($participant['individualPosition']);

        if($currentParticipantKey < 5){
            $summonerMatch->team = "blue";
        }
        else{
            $summonerMatch->team = 'red';
        }

        if($participant['win'] == 'Win'){
            $summonerMatch->didWin = 1;
        }else{
            $summonerMatch->didWin = 0;
        }
        
        $summonerMatch->match_id = $matchId;

        $summonerMatch->save();
    }
}