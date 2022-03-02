<!DOCTYPE html>
<html>

<head>
    <title>Match {{$match->match_id}}</title>
</head>
@include('head')

<body class="antialiased">
    <div class="flex pt-24 pb-5">
        <div class="grid bg-zinc-900 rounded-lg shadow-xl w-min mx-auto 3xl:w-11/12">
            <div class="flex justify-start py-2 px-3">
                <div class="flex">
                    <h1 class="text-gray-200 font-bold text-4xl">Match Id: {{$match->match_id}}</h1>
                </div>
            </div>

            <div class="mx-4 my-3 text-gray-200">
                <div class="mt-4">
                    <span class="text-2xl font-bold">Bans</span>
                    <div class="sm:flex flex-row flex-wrap mt-2">
                        @foreach($bans as $ban)
                        <div class="mx-2 flex-1">
                            <h2 class="mx-auto text-xl font-semibold">
                                <a class="hover:text-gray-200 text-gray-400" href="/champion/{{$ban->name}}">
                                    {{$ban->name}}
                                </a>
                            </h2>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div
                class="mx-4 my-3 sm:grid gap-6 grid-rows-2 grid-cols-1 text-gray-200 min-w-max">
                <div class="mt-4 w-full">
                    <span class="text-2xl font-bold text-blue-600">Blue Team @if($summonerMatches[0]->didWin) won @endif</span>
                    <div class="grid grid-cols-9 ml-2 mt-2 gap-1">
                        <div class="col-span-1">
                            <h2 class="px-0.5 text-xl font-semibold">Name</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Champion</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Role</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Level</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Kills</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Deaths</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Assists</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">KDA</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Farm</h2>
                        </div>
                    </div>
                    @foreach($summonerMatches as $key=>$summonerMatch)
                    @if($key < 5) 
                    <div class="grid grid-cols-9 ml-2 mt-2 gap-1 text-gray-400">
                        <div class="col-span-1">
                            <h2 class="px-0.5 text-xl font-semibold">
                                <a class="hover:text-gray-200" href="/summoner/{{$summonerMatch->summoner->name}}">
                                {{$summonerMatch->summoner->name}}
                                </a>
                            </h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">
                                <a class="hover:text-gray-200" href="/champion/{{$summonerMatch->champion->name}}">
                                {{$summonerMatch->champion->name}}
                                </a>
                            </h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{ucfirst($summonerMatch->role)}}</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->level}}</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->kills}}</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->deaths}}</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->assists}}</h2>
                        </div>
                        <div>
                            @if($summonerMatch->assists + $summonerMatch->kills == 0 || $summonerMatch->deaths == 0)
                            <h2 class="px-0.5 text-xl font-semibold">0</h2>
                            @else
                            <h2 class="px-0.5 text-xl font-semibold">{{round(($summonerMatch->assists + $summonerMatch->kills) / $summonerMatch->deaths, 3)}}</h2>
                            @endif
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->farm}}</h2>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
                <div class="mt-4 w-full">
                    <span class="text-2xl font-bold text-red-600">Red Team @if($summonerMatches[5]->didWin) won @endif</span>
                    <div class="grid grid-cols-9 ml-2 mt-2 content-evenly gap-1">
                        <div class="col-span-1">
                            <h2 class="px-0.5 text-xl font-semibold">Name</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Champion</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Role</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Level</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Kills</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Deaths</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Assists</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">KDA</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">Farm</h2>
                        </div>
                    </div>
                    @foreach($summonerMatches as $key=>$summonerMatch)
                    @if($key > 4) 
                    <div class="grid grid-cols-9 ml-2 mt-2 content-evenly gap-1 text-gray-400">
                    <div class="col-span-1">
                            <h2 class="px-0.5 text-xl font-semibold">
                                <a class="hover:text-gray-200" href="/summoner/{{$summonerMatch->summoner->name}}">
                                {{$summonerMatch->summoner->name}}
                                </a>
                            </h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">
                                <a class="hover:text-gray-200" href="/champion/{{$summonerMatch->champion->name}}">
                                {{$summonerMatch->champion->name}}
                                </a>
                            </h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{ucfirst($summonerMatch->role)}}</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->level}}</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->kills}}</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->deaths}}</h2>
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->assists}}</h2>
                        </div>
                        <div>
                            @if($summonerMatch->assists + $summonerMatch->kills == 0 || $summonerMatch->deaths == 0)
                            <h2 class="px-0.5 text-xl font-semibold">0</h2>
                            @else
                            <h2 class="px-0.5 text-xl font-semibold">{{round(($summonerMatch->assists + $summonerMatch->kills) / $summonerMatch->deaths, 3)}}</h2>
                            @endif
                        </div>
                        <div>
                            <h2 class="px-0.5 text-xl font-semibold">{{$summonerMatch->farm}}</h2>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</body>

</html>