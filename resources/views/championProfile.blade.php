<!DOCTYPE html>
<html>

<head>
    <title>{{$champion->name}}</title>
</head>
@include('head')

<body class="antialiased">
    <div class="flex items-center justify-center pt-24 pb-5">
        <div class="grid bg-zinc-900 rounded-lg shadow-xl w-11/12">
            <div class="flex justify-start py-2 px-3">
                <div class="flex">
                    <h1 class="text-gray-200 font-bold text-4xl">{{$champion->name}}</h1>
                </div>
            </div>

            <div class="mt-4 mx-4">
                <div class="sm:grid grid-cols-7 mt-3">
                    <div>
                        <span class="text-gray-200 text-md">Total Games</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['totalGames']}}</h2>
                    </div>
                    <div>
                        <span class="text-gray-200 text-md">Win Count</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['winCount']}}</h2>
                    </div>
                    <div>
                        <span class="text-gray-200 text-md">Loss Count</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['lossCount']}}</h2>
                    </div>
                    <div>
                        <span class="text-gray-200 text-md">Win Rate</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['winRate']}}%</h2>
                    </div>
                    <div>
                        <span class="text-gray-200 text-md">Pick Rate</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['pickRate']}}%</h2>
                    </div>
                    <div>
                        <span class="text-gray-200 text-md">Ban Rate</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['banRate']}}%</h2>
                    </div>
                    <div>
                        <span class="text-gray-200 text-md">Pick Ban Rate</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['pickBanRate']}}%</h2>
                    </div>
                </div>
            </div>

            <div class="mx-4 my-3 sm:grid gap-6 grid-cols-2 text-gray-200">
                <div class="mt-4">
                    <span class="text-2xl font-bold">Total Stats</span>
                    <div class="sm:grid grid-cols-3 ml-2 mt-2">
                        <div>
                            <span class="text-md">Kills</span>
                            <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['totalKills']}}
                            </h2>
                        </div>
                        <div>
                            <span class=" text-md">Deaths</span>
                            <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['totalDeaths']}}
                            </h2>
                        </div>
                        <div>
                            <span class="text-md">Assists</span>
                            <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['totalAssists']}}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="text-2xl font-bold">Average Stats Per Game</span>
                    <div class="sm:grid grid-cols-5 ml-2 mt-2">
                        <div>
                            <span class="text-md">Kills</span>
                            <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['averageKills']}}
                            </h2>
                        </div>
                        <div>
                            <span class=" text-md">Deaths</span>
                            <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['averageDeaths']}}
                            </h2>
                        </div>
                        <div>
                            <span class="text-md">Assists</span>
                            <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['averageAssists']}}
                            </h2>
                        </div>
                        <div>
                            <span class="text-md">KDA</span>
                            <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['averageKda']}}</h2>
                        </div>
                        <div>
                            <span class="text-md">Farm</span>
                            <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$championData['averageFarm']}}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:ml-0 ml-4 pl-0 sm:pl-4">
                <span class="text-2xl font-bold">Most Played By</span>
                <div class="sm:grid grid-cols-1 ml-1 mt-2">
                    <div>
                        @if($championData['mostPlayedBy'] != "")
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">
                            @foreach ($championData['mostPlayedBy'] as $key => $mostPlayed)
                            <a class="hover:text-gray-200" href="/summoner/{{$mostPlayed->name}}">
                                {{$mostPlayed->name}}
                            </a>
                                @if($key < count($championData['mostPlayedBy']) - 1) 
                                    & 
                                @endif 
                            @endforeach 
                        </h2>
                        @else
                            <h2 class="px-0.5 text-gray-400 text-xl font-semibold">
                                No One
                            </h2>
                        @endif
                    </div>
                </div>
            </div>
            <div>
                <div class="mt-4 sm:ml-0 ml-4 pl-0 sm:pl-4 text-gray-200">
                    <span class="text-2xl font-bold">Latest Games</span> 
                    <div class="mt-3">
                        @if(count($games)!= 0)
                        @foreach ($games as $game)
                        <div class="bg-zinc-900 mx-auto border rounded-sm mb-0.5 h-30 mt-2">
                            @if($game->didWin == 1)
                            <div class="flex p-3 border-l-8 border-blue-600">
                                @else
                                <div class="flex p-3 border-l-8 border-red-600">
                                    @endif
                                    <div class="space-y-1 border-r-2 pr-3">
                                        <div class="text-md leading-5 font-semibold">
                                            @if($game->didWin == 1)
                                            Win
                                            @else
                                            Loss
                                            @endif
                                        </div>
                                        <div class="text-sm leading-5 font-semibold"><span
                                                class="text-md leading-4 font-normal text-gray-500">
                                                Role:
                                            </span>
                                            {{ucfirst($game->role)}}
                                        </div>
                                        <div class="text-sm leading-5 font-semibold"><span
                                                class="text-md leading-4 font-normal text-gray-500">
                                                Game Duration:
                                            </span>
                                            {{$game->match->game_time}}
                                        </div>
                                        <div class="text-sm leading-5 font-semibold"><span
                                                class="text-md leading-4 font-normal text-gray-500">
                                                Game Date:
                                            </span>
                                            {{date('d.m.Y', strtotime($game->match->game_date))}}
                                        </div>
                                        <div class="text-sm leading-5 font-semibold"><span
                                                class="text-md leading-4 font-normal text-gray-500">
                                                Game ID:
                                            </span>
                                            {{$game->match_id}}
                                        </div>
                                    </div>
                                    <div class="flex-1 md:grid grid-cols-6 ml-2 md:py-9 border-r-2 space-y-1 gap-x-2">
                                        <div class="text-xl leading-6 font-normal col-span-2">
                                            <a href="/summoner/{{$game->summoner->name}}">
                                                <div class="hover:text-gray-400">
                                                    {{$game->summoner->name}}
                                                </div>
                                            </a>
                                        </div>
                                        <div class="text-md leading-4 font-normal">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                Kills
                                            </span>
                                            {{$game->kills}}
                                        </div>
                                        <div class="text-md leading-4 font-normal">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                Deaths
                                            </span>
                                            {{$game->deaths}}
                                        </div>
                                        <div class="text-md leading-4 font-normal">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                Assists
                                            </span>
                                            {{$game->assists}}
                                        </div>
                                        <div class="text-md leading-4 font-normal row-start-2 col-start-4">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                KDA
                                            </span>
                                            {{round(($game->assists + $game->kills) / $game->deaths, 3)}}
                                        </div>
                                        <div class="text-md leading-4 font-normal">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                Farm
                                            </span>
                                            {{$game->farm}}
                                        </div>
                                    </div>
                                    <div class="grid content-center">
                                        <a href="/matches/{{$game->match_id}}">
                                            <div
                                                class="ml-3 bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white p-0.5 w-20">
                                                <div
                                                    class="uppercase text-xs leading-4 font-semibold text-center text-yellow-100">
                                                    Go to game
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <div>
                                <h2 class="px-0.5 text-gray-400 text-md font-semibold">No one has played this
                                    champion yet. Go play some games as {{$champion->name}}
                                </h2>
                            </div>
                            @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>