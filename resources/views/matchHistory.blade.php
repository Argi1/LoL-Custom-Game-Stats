<!DOCTYPE html>
<html>

<head>
    <title>All Custom Matches</title>
</head>
@include('head')

<body class="antialiased">
    <div class="flex pt-24 pb-5">
        <div class="grid bg-zinc-900 rounded-lg shadow-xl w-min mx-auto md:w-11/12">
            <div class="flex justify-start py-2 px-3">
                <div class="flex">
                    <h1 class="text-gray-200 font-bold text-4xl">Match History</h1>
                </div>
            </div>

            <div class="mt-4 mx-4">
                <div class="sm:grid grid-cols-1 mt-3 ">
                    <div>
                        <span class="text-gray-200 text-md">Total Games Played</span>
                        <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$matchCount}}</h2>
                    </div>
                </div>
            </div>
            <div>
                <div class="mx-4 my-3 text-gray-200">
                    <div class="mt-4">
                        <span class="text-2xl font-bold">Latest Games</span>
                    </div>
                    <div class="mt-3">
                        @foreach ($allMatches as $match)
                        <div class="bg-zinc-900 mx-auto border rounded-sm mb-0.5 mt-2">
                            @if($winningTeamInMatches[$match->match_id] == 'blue')
                            <div class="flex flex-row flex-wrap p-3 border-l-8 border-blue-600">
                                @else
                                <div class="flex flex-row flex-wrap p-3 border-l-8 border-red-600">
                                    @endif
                                    <div class="space-y-1 border-r-2 pr-3">
                                        <div class="text-xl pb-1 leading-5 font-semibold">
                                            @if($winningTeamInMatches[$match->match_id] == 'blue')
                                            Blue
                                            @else
                                            Red
                                            @endif
                                            team won
                                        </div>
                                        <div class="text-sm leading-5 font-semibold"><span
                                                class="text-md leading-4 font-normal text-gray-500">
                                                Game ID:
                                            </span>
                                            {{$match->match_id}}
                                        </div>
                                        <div class="text-sm leading-5 font-semibold"><span
                                                class="text-md leading-4 font-normal text-gray-500">
                                                Game Duration:
                                            </span>
                                            {{$match->game_time}}
                                        </div>
                                        <div>
                                            <a href="/matches/{{$match->match_id}}">
                                                <div
                                                    class=" bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white p-0.5 w-20">
                                                    <div
                                                        class="uppercase text-xs leading-4 font-semibold text-center text-yellow-100">
                                                        Go to game
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="space-y-1 pr-3 grow ml-3">
                                        <div class="flex">
                                            <table class="flex-1 grow">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <div class="mt-3 text-xl text-blue-600">
                                                                Blue Team
                                                            </div>
                                                        </th>
                                                        <th class="text-xl px-2  text-gray-300">
                                                            Champion
                                                        </th>
                                                        <th class="text-xl px-2  text-gray-300">
                                                            Role
                                                        </th>
                                                        <th class="text-xl px-2  text-gray-300">
                                                            Level
                                                        </th>
                                                        <th class="text-xl px-2  text-gray-300">
                                                            Kills
                                                        </th>
                                                        <th class="text-xl px-2  text-gray-300">
                                                            Deaths
                                                        </th>
                                                        <th class="text-xl px-2  text-gray-300">
                                                            Assists
                                                        </th>
                                                        <th class="text-xl px-2  text-gray-300">
                                                            Farm
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody class="divide-y divide-gray-300/25">
                                                    @foreach($match->summonerMatches as $key=>$player)

                                                    <tr class="text-gray-300 py-1 text-sm">
                                                        <td class="px-2">
                                                            <a href="/summoner/{{$player->summoner->name}}">
                                                                <div class="text-sm hover:text-gray-400">
                                                                    {{$player->summoner->name}}
                                                                </div>
                                                            </a>
                                                        </td>
                                                        <td class="px-2">
                                                            <a
                                                                href="/champion/{{$player->champion->name}}">
                                                                <div class="text-sm hover:text-gray-400">
                                                                    {{$player->champion->name}}
                                                                </div>
                                                        </td>
                                                        <td class="px-2">
                                                            <div class="text-sm">
                                                                {{ucfirst($player->role)}}
                                                            </div>
                                                        </td>
                                                        <td class="px-2">
                                                            <div class="text-sm">
                                                                {{$player->level}}
                                                            </div>
                                                        </td>
                                                        <td class="px-2">
                                                            <div class="text-sm">
                                                                {{$player->kills}}
                                                            </div>
                                                        </td>
                                                        <td class="px-2">
                                                            <div class="text-sm">
                                                                {{$player->deaths}}
                                                            </div>
                                                        </td>
                                                        <td class="px-2">
                                                            <div class="text-sm">
                                                                {{$player->assists}}
                                                            </div>
                                                        </td>
                                                        <td class="px-2">
                                                            <div class="text-sm">
                                                                {{$player->farm}}
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @if($key == 4)
                                                    <tr>
                                                        <td>
                                                            <div class="text-xl font-bold text-red-600">
                                                                Red Team
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    @endforeach
                                                    <tr class="border-b"></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>