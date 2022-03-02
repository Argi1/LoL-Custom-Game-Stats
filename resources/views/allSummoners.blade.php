<!DOCTYPE html>
<html>

<head>
    <title>Summoners</title>
</head>
@include('head')

<body class="antialiased">
    <div class="flex pt-24 pb-5">
        <div class="grid bg-zinc-900 rounded-lg shadow-xl w-min mx-auto xl:w-11/12">
            <div class="flex justify-start py-2 px-3">
                <div class="flex">
                    <h1 class="text-gray-200 font-bold text-4xl">All Summoners Stats</h1>
                </div>
            </div>

            <div class="mx-4 my-3 text-gray-200 mt-4">
                <div class="flex">
                    <table class="flex-1 grow table-auto !border-2 !border-gray-200/60 whitespace-nowrap" data-sortable>
                        <thead>
                            <tr class="text-xl !border-2 !border-gray-200/60">
                                <th class="border-r border-gray-200/60">Summoner Name</th>
                                <th>Game Count</th>
                                <th>Games Won</th>
                                <th class="border-r !border-gray-200/60">Win %</th>
                                <th>Kills</th>
                                <th>Deaths</th>
                                <th>Assists</th>
                                <th class="border-r !border-gray-200/60">KDA</th>
                                <th>Top</th>
                                <th>Jungle</th>
                                <th>Mid</th>
                                <th>Adc</th>
                                <th>Support</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($summoners as $summoner)
                            <tr class="text-md !border !border-gray-200/25">
                                <td class="border-r border-gray-200/60 font-semibold !pr-6">
                                    <a class="hover:text-gray-400" href="summoner/{{$summoner->name}}">
                                        {{$summoner->name}}
                                    </a>
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->summonerMatches->count()}}
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->summonerMatches->where('didWin', 1)->count()}}
                                </td>
                                <td class="border-r !pr-6">
                                    @if($summoner->summonerMatches->where('didWin', 1)->count() != 0)
                                    {{round($summoner->summonerMatches->where('didWin', 1)->count() /
                                    $summoner->summonerMatches->count() * 100,2)}}%
                                    @else
                                    0%
                                    @endif
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->total_kills}}
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->total_deaths}}
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->total_assists}}
                                </td>
                                <td class="border-r pr-6 border-gray-200/40">
                                    @if($summoner->total_kills + $summoner->total_assists != 0 &&
                                    $summoner->total_deaths != 0)
                                    {{round(($summoner->total_assists + $summoner->total_kills) /
                                    $summoner->total_deaths, 3)}}
                                    @else
                                    0
                                    @endif
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->summonerMatches->where('role', 'top')->count()}}
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->summonerMatches->where('role', 'jungle')->count()}}
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->summonerMatches->where('role', 'middle')->count()}}
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->summonerMatches->where('role', 'adc')->count()}}
                                </td>
                                <td class="!pr-6">
                                    {{$summoner->summonerMatches->where('role', 'support')->count()}}
                                </td>
                            </tr>
                            @endforeach
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>