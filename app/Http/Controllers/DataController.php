<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Champion;
use App\Models\Summoner;
use App\Models\SummonerMatch;
use App\Models\MatchHistory;
use App\Extensions\ReplaybookDataConvert;

class DataController extends Controller
{
    public function showIndex()
    {
        return view('index');
    }

    public function autocompleteSearch(Request $request)
    {
          $query = $request->get('query');
          $filterResult = Champion::where('name', 'LIKE', '%'. $query. '%')->get();
          return response()->json($filterResult);
    }

    // Check if there exists a champion with the name that was searched.
    // If none exist, try to show the page for the summoner with the name searched.
    public function search(Request $request){
        $search = $request->input('search');

        $champion = Champion::select('name')->firstWhere('name', $search);
        
        if($champion == null){
            $summoner = Summoner::select('name')->firstWhere('name', $search);
            
            if($summoner != null){
                return redirect('summoner/' . $search);
            }
            return redirect('/')->withSuccess("No summoner or champion found with name " . $search);
        }
        return redirect('champion/' . $champion->name);
    }

    // Get summoner by name, get all relevant info and all the games played by this summoner and pass it to page.
    public function showSummoner($name){
        $summoner = Summoner::firstWhere('name', $name);
        $summonerData = array();

        $games = $summoner->summonerMatches->sortByDesc('created_at');

        $summonerData['gameCount'] = $games->count();
        $summonerData['winCount'] = $games->where('didWin', 1)->count();
        $summonerData['lossCount'] = $games->where('didWin', 0)->count();
        $summonerData['top'] = $games->where('role', 'top')->count();
        $summonerData['mid'] = $games->where('role', 'middle')->count();
        $summonerData['adc'] = $games->where('role', 'adc')->count();
        $summonerData['jungle'] = $games->where('role', 'jungle')->count();
        $summonerData['support'] = $games->where('role', 'support')->count();

        return view('summonerProfile', ['summoner' => $summoner, 'summonerData' => $summonerData, 'games' => $games]);
    }

    public function showChampion($name){
        $champion = Champion::firstWhere('name', $name);
        $id = $champion->idchampion;

        $championData = array();

        $games = $champion->championMatches->sortByDesc('created_at');
        
        $totalMatchCount = MatchHistory::count();
        $totalGameCount = $games->count();

        // Count all the bans that have been made against this champion.
        $banCount = MatchHistory::where('ban1', $id)
        ->orWhere('ban2', $id)
        ->orWhere('ban3', $id)
        ->orWhere('ban4', $id)
        ->orWhere('ban5', $id)
        ->orWhere('ban6', $id)
        ->orWhere('ban7', $id)
        ->orWhere('ban8', $id)
        ->orWhere('ban9', $id)
        ->orWhere('ban10', $id)->count();


        

        $championData['totalGames'] = $totalGameCount;

        $championData['winCount'] = $games->where('didWin', 1)->count();
        $championData['lossCount'] = $games->where('didWin', 0)->count();

        // If statements to avoid division by zero, by setting the value to 0 inherently.
        if($banCount == 0 && count($games) == 0){
            $championData['pickBanRate'] = 0;
        }else{
            $championData['pickBanRate'] = round(($banCount + $totalGameCount) / $totalMatchCount * 100 , 3);
        }

        if($banCount != 0){
            $championData['banRate'] = round($banCount / $totalMatchCount * 100, 3);
        }else{
            $championData['banRate'] = 0;
        }

        if(count($games) != 0){
            $championData['totalAssists'] = $games->toQuery()->sum('assists');
            $championData['totalDeaths'] = $games->toQuery()->sum('deaths');
            $championData['totalKills'] = $games->toQuery()->sum('kills');

            $championData['pickRate'] = round($totalGameCount / $totalMatchCount * 100, 3);
            $championData['winRate'] = round($championData['winCount'] / $totalGameCount * 100, 3);

            $championData['averageKills'] = round($championData['totalKills'] / $totalGameCount, 3);
            $championData['averageDeaths'] = round($championData['totalDeaths'] / $totalGameCount, 3);
            $championData['averageAssists'] = round($championData['totalAssists'] / $totalGameCount, 3);
            $championData['averageKda'] = round(($championData['totalAssists'] + $championData['totalKills']) / $championData['totalDeaths'], 3);

            $summonersChampionPlayCounts = $games->toQuery()->selectRaw('summoner_id, count(*)')->groupBy('summoner_id')->orderByRaw('COUNT(*) DESC')->limit(5)->get();
            $highestPlayCount = $summonersChampionPlayCounts[0]['count(*)'];
            $summonersWhoPlayedMost = array();

            foreach($summonersChampionPlayCounts as $key => $summoner){
                if($summoner['count(*)'] == $highestPlayCount){
                    $summonersWhoPlayedMost[$key] = $summoner->summoner_id;
                }
            }

            $championData['mostPlayedBy'] = Summoner::select('name')->whereIn('summoner_id', $summonersWhoPlayedMost)->get();

            $championData['averageFarm'] = round($games->toQuery()->sum('farm') / $totalGameCount, 0);
        }
        else{
            $championData['pickRate'] = 0;
            $championData['winRate'] = 0;
            $championData['averageKills'] = 0;
            $championData['averageDeaths'] = 0;
            $championData['averageAssists'] = 0;
            $championData['averageKda'] = 0;
            $championData['mostPlayedBy'] = "";
            $championData['averageFarm'] = 0;
            $championData['totalAssists'] = 0;
            $championData['totalDeaths'] = 0;
            $championData['totalKills'] = 0;
        }
        return view('championProfile', ['champion' => $champion, 'championData' => $championData, 'games' => $games]);
    }

    public function showMatchHistory(){
        $allMatches = MatchHistory::all();
        $totalMatchCount = $allMatches->count();

        $winningTeamInMatches = array();

        foreach($allMatches as $match){
            if($match->summonerMatches->toQuery()->select('didWin')->firstWhere('team', 'blue')->didWin == 1){
                $winningTeamInMatches[$match->match_id] = 'blue';
            }
            else{
                $winningTeamInMatches[$match->match_id] = 'red';
            }
        }

        return view('matchHistory', ['matchCount' => $totalMatchCount, 'allMatches' => $allMatches, 'winningTeamInMatches' => $winningTeamInMatches]);
    }

    public function showMatch($id){
        $match = MatchHistory::firstWhere('match_id', $id);
        $summonerMatches = $match->summonerMatches;
        $bans = Champion::select('name')->whereIn('champion_id', $match->only(['ban1','ban2','ban3','ban4','ban5','ban6','ban7','ban8','ban9','ban10']))->get();

        return view('match', ['match' => $match, 'summonerMatches' => $summonerMatches, 'bans' => $bans]);
    }

    public function showAllSummoners(){
        $summoners = Summoner::orderBy('name')->get();
        

        return view('allSummoners', ['summoners' => $summoners]);
    }

    public function showAllChampions(){
        $champions = Champion::orderBy('name')->get();
        $matchCount = MatchHistory::count();
        $banCount = array();

        foreach($champions as $champion){
            $id = $champion->champion_id;
            $banCount[$champion->name] = MatchHistory::where('ban1', $id)
            ->orWhere('ban2', $id)
            ->orWhere('ban3', $id)
            ->orWhere('ban4', $id)
            ->orWhere('ban5', $id)
            ->orWhere('ban6', $id)
            ->orWhere('ban7', $id)
            ->orWhere('ban8', $id)
            ->orWhere('ban9', $id)
            ->orWhere('ban10', $id)->count();
        }

        return view('allChampions', ['champions' => $champions, 'matchCount' => $matchCount, 'banCount' => $banCount]);
    }
}