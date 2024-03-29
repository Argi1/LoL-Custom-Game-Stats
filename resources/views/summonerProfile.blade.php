<!DOCTYPE html>
<html>

<head>
    <title>{{$summoner->name}}</title>
</head>
@include('head')

<body class="antialiased">
<div class="flex items-center justify-center pt-24 pb-5">
    <div class="grid bg-zinc-900 rounded-lg shadow-xl w-11/12 min-w-fit">
        <div class="flex justify-start py-2 px-3">
            <div class="flex">
                <h1 class="text-gray-200 font-bold text-4xl">{{$summoner->name}}</h1>
            </div>
        </div>

        <div class="mt-4 mx-4">
            <div class="sm:grid grid-cols-4 mt-3 ">
                <div>
                    <span class="text-gray-200 text-md">Games Played</span>
                    <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summonerData['gameCount']}}</h2>
                </div>
                <div>
                    <span class="text-gray-200 text-md">Games Won</span>
                    <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summonerData['winCount']}}</h2>
                </div>
                <div>
                    <span class="text-gray-200 text-md">Games Lost</span>
                    <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summonerData['lossCount']}}</h2>
                </div>
                <div>
                    <span class="text-gray-200 text-md">Win %</span>
                    <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{round($summonerData['winCount'] /
                            $summonerData['gameCount'] * 100, 3)}}%</h2>
                </div>
            </div>
        </div>

        <div class="mx-4 my-3 sm:grid gap-6 grid-cols-2 text-gray-200">
            <div class="mt-4">
                <span class="text-2xl font-bold">Role Playcount</span>
                <div class="sm:grid grid-cols-5 ml-2 mt-2">
                    <div>
                        <span class="text-md">Top</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summonerData['top']}}</h2>
                    </div>
                    <div>
                        <span class=" text-md">Mid</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summonerData['mid']}}</h2>
                    </div>
                    <div>
                        <span class="text-md">Jungle</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summonerData['jungle']}}</h2>
                    </div>
                    <div>
                        <span class="text-md">Adc</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summonerData['adc']}}</h2>
                    </div>
                    <div>
                        <span class="text-md">Support</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summonerData['support']}}</h2>
                    </div>
                </div>
            </div>
            <div class="mt-4 sm:pl-4">
                <span class="text-2xl font-bold">Total Stats</span>
                <div class="sm:grid grid-cols-4 ml-2 mt-2">
                    <div>
                        <span class="text-md">Kills</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summoner->total_kills}}</h2>
                    </div>
                    <div>
                        <span class=" text-md">Deaths</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summoner->total_deaths}}</h2>
                    </div>
                    <div>
                        <span class="text-md">Assists</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$summoner->total_assists}}</h2>
                    </div>
                    <div>
                        <span class="text-md">KDA</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">
                            @if($summoner->total_assists == 0 && $summoner->total_kills == 0 && $game->total_deaths == 0)
                                0
                            @else
                                {{round(max($summoner->total_kills + $summoner->total_assists, 1) / max($summoner->total_deaths, 1), 3)}}
                            @endif
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="mt-4 px-4 mb-4 text-gray-200">
                <span class="text-2xl font-bold">Latest Games</span>
                <div class="mt-3">
                    @foreach ($games as $game)
                        <div class="bg-zinc-900 mx-auto border rounded-sm mb-0.5 h-30 mt-2 min-w-min">
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
                                            <div
                                                class="flex-1 md:grid grid-cols-6 ml-2 border-r-2 space-y-1 gap-x-2 min-w-fit">
                                                <div
                                                    class="text-xl leading-6 font-normal col-span-2 row-span-2 my-auto">
                                                    <a href="/champion/{{$game->champion->name}}">
                                                        <div
                                                            class="hover:text-gray-400 flex flex-row gap-1 my-auto">
                                                            <img class="w-20"
                                                                 src="{{url('../img/' . $game->champion->getChampionImgName() . '.png')}}"/>
                                                            <p class="my-auto">{{$game->champion->name}}</p>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="text-md leading-4 font-normal my-auto">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                Kills
                                            </span>
                                                    {{$game->kills}}
                                                </div>
                                                <div class="text-md leading-4 font-normal my-auto">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                Deaths
                                            </span>
                                                    {{$game->deaths}}
                                                </div>
                                                <div class="text-md leading-4 font-normal my-auto">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                Assists
                                            </span>
                                                    {{$game->assists}}
                                                </div>
                                                <div
                                                    class="text-md leading-4 font-normal row-start-2 col-start-4 my-auto">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                KDA
                                            </span>
                                                    @if($game->assists == 0 && $game->kills == 0 && $game->deaths == 0)
                                                        0
                                                    @else
                                                        {{round(max($game->assists + $game->kills, 1) / max($game->deaths, 1), 3)}}
                                                    @endif
                                                </div>
                                                <div class="text-md leading-4 font-normal my-auto">
                                            <span class="text-md leading-4 font-normal text-gray-500">
                                                Farm
                                            </span>
                                                    {{$game->farm}}
                                                </div>
                                            </div>
                                            <div class="grid content-center min-w-fit">
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
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>
