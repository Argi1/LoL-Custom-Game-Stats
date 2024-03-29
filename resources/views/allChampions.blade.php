<!DOCTYPE html>
<html>

<head>
    <title>Champions</title>
</head>
@include('head')

<body class="antialiased">
<div class="flex pt-24 pb-5">
    <div class="grid bg-zinc-900 rounded-lg shadow-xl w-min mx-auto xl:w-11/12">
        <div class="flex justify-start py-2 px-3">
            <div class="flex">
                <h1 class="text-gray-200 font-bold text-4xl">All Champions Stats</h1>
            </div>
        </div>

        <div class="mt-4 mx-4">
            <div class="flex">
                <div class="flex-1">
                    <span class="text-gray-200 text-md">Total Games</span>
                    <h2 class="px-0.5 text-gray-400 text-xl font-semibold">{{$matchCount}}</h2>
                </div>
            </div>
        </div>

        <div class="mx-4 my-3 text-gray-200">
            <div class="flex">
                <table class="flex-1 grow table-auto !border-2 !border-gray-200/60 whitespace-nowrap"
                       data-sortable>
                    <thead>
                    <tr class="text-xl !border-2 !border-gray-200/60">
                        <th class="border-r border-gray-200/60">Champion</th>
                        <th>Pick Count</th>
                        <th class="border-r !border-gray-200/60">Ban Count</th>
                        <th>Wins</th>
                        <th class="border-r !border-gray-200/60">Losses</th>
                        <th class="border-r !border-gray-200/60">Win Rate</th>
                        <th>Pick Rate</th>
                        <th>Ban Rate</th>
                        <th>Pick/Ban Rate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($champions as $champion)
                        <tr class="text-md !border !border-gray-200/25">
                            <td class="border-r border-gray-200/60 !font-semibold mx-auto">
                                <a class="hover:text-gray-400 mx-auto flex flex-col"
                                   href="/champion/{{$champion->name}}">
                                    <img class="mx-auto w-1/3"
                                         src="{{url('../img/' . $champion->getChampionImgName() . '.png')}}"/>
                                    {{$champion->name}}
                                </a>
                            </td>
                            <td class="!pr-3">
                                <p class="text-xl font-semibold">
                                    {{$champion->championMatches->count()}}
                                </p>
                            </td>
                            <td class="border-r !pr-3 !border-gray-200/60">
                                <p class="text-xl font-semibold">
                                    {{$banCount[$champion->name]}}
                                </p>
                            </td>
                            <td class="!pr-3">
                                <p class="text-xl font-semibold">
                                    {{$champion->championMatches->where('didWin', 1)->count()}}
                                </p>
                            </td>
                            <td class="!pr-3 border-r !border-gray-200/60">
                                <p class="text-xl font-semibold">
                                    {{$champion->championMatches->where('didWin', 0)->count()}}
                                </p>
                            </td>
                            <td class="!pr-3 border-r !border-gray-200/60">
                                @if($champion->championMatches->where('didWin', 1)->count() != 0)
                                    <p class="text-xl font-semibold">
                                        {{round($champion->championMatches->where('didWin', 1)->count() /
                                        $champion->championMatches->count() * 100, 3)}}%
                                    </p>
                                @else
                                    <p class="text-xl font-semibold">
                                        0%
                                    </p>
                                @endif
                            </td>
                            <td class="!pr-3">
                                @if($champion->championMatches->count() != 0)
                                    <p class="text-xl font-semibold">
                                        {{round($champion->championMatches->count() /
                                        $matchCount * 100,2)}}%
                                    </p>
                                @else
                                    <p class="text-xl font-semibold">
                                        0%
                                    </p>
                                @endif
                            </td>
                            <td class="!pr-6">
                                @if($banCount[$champion->name] != 0)
                                    <p class="text-xl font-semibold">
                                        {{round($banCount[$champion->name] /
                                        $matchCount * 100,2)}}%
                                    </p>
                                @else
                                    <p class="text-xl font-semibold">
                                        0%
                                    </p>
                                @endif
                            </td>
                            <td class="!pr-6">
                                @if($banCount[$champion->name] + $champion->championMatches->count() != 0 )
                                    <p class="text-xl font-semibold">
                                        {{round(($banCount[$champion->name] + $champion->championMatches->count()) /
                                        $matchCount * 100,2)}}%
                                    </p>
                                @else
                                    <p class="text-xl font-semibold">
                                        0%
                                    </p>
                                @endif
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
