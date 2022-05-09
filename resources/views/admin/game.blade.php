<!DOCTYPE html>
<html>

<head>
  <title>Custom Game</title>
</head>
@include('head')

<body class="antialiased">
  <div class="flex pt-24 pb-5">
    <div class="grid bg-zinc-900 rounded-lg shadow-xl mx-auto sm:w-11/12 w-7/12">
      <div class="flex justify-center py-2">
      </div>

      <div class="flex justify-center">
        <div class="flex">
          <h1 class="text-gray-200 font-bold md:text-2xl text-xl">Upload Game</h1>
        </div>
      </div>

      <div class="flex justify-center mt-2">
        @if (session('success'))
        <div class="alert alert-success mt-3 w-fit">
          {{ session('success') }}
        </div>
        @endif
        @if (session('fail'))
          <div class="alert alert-danger mt-3 w-fit">
            {{ session('fail') }}
          </div>
        @endif
      </div>

      <form method="post" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Upload game
            replay</label>
          <input
            class="mt-1 block w-full text-sm border-2 text-gray-200 rounded-lg focus:ring-2 bg-neutral-900 border-purple-300 cursor-pointer focus:outline-none"
            id="game-replay" type="file" accept="application/json" required name="replay">
        </div>

        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 1</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban1" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 2</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban2" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 3</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban3" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 4</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban4" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 5</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban5" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 6</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban6" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 7</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban7" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 8</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban8" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 9</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban9" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Ban 10</label>
          <input
            class="py-2 px-3 rounded-lg border-2 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="text" list="champions" placeholder="Champion name" required name="ban10" />
        </div>
        <div class="grid grid-cols-1 mt-3 mx-7">
          <label class="uppercase md:text-sm text-xs text-gray-200  font-semibold">Date of Game</label>
          <input
            class="py-2 px-3 rounded-lg border-2 text-gray-500 border-purple-300 mt-1 focus:outline-none focus:ring-2 bg-neutral-900"
            type="date" required name="dateOfGame"/>
        </div>

        <datalist id="champions">
          @foreach($championList as $champion)
          <option>{{$champion->name}}</option>
          @endforeach
        </datalist>

        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-4 pb-4'>
          <button
            class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Create</button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>