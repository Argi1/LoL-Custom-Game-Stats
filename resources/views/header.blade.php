<!DOCTYPE html>
<html>
    <nav class="bg-zinc-800 p-2 mt-0 fixed w-full z-10 top-0">
        <div class="container mx-auto flex flex-wrap items-center">
		    <div class="flex w-full lg:w-1/2 justify-center lg:justify-start text-white font-extrabold">
				<a class="text-gray-200 no-underline hover:text-gray-200 hover:no-underline" href="/">
					<span class="text-2xl pl-2">Zilean OÜ</span>
				</a>
            </div>
			<div class="flex w-full pt-2 content-center justify-between lg:w-1/2 lg:justify-end">
				<ul class="list-reset flex justify-between flex-1 lg:flex-none items-center">
				  <li class="mr-3">
					<a class="inline-block py-2 px-2 text-gray-200 no-underline hover:text-gray-400 hover:text-underline" href="/champion">Champions</a>
				  </li>
				  <li class="mr-3">
					<a class="inline-block text-gray-200 no-underline hover:text-gray-400 hover:text-underline py-2 px-2" href="/summoner">Summoners</a>
				  </li>
				  <li class="mr-3">
					<a class="inline-block text-gray-200 no-underline hover:text-gray-400 hover:text-underline py-2 px-2" href="/matches">Match History</a>
				  </li>
                  @guest
					<li class="mr-3">
					<a class="inline-block text-gray-200 no-underline hover:text-gray-400 hover:text-underline py-2 px-2" href="/signin">Sign In</a>
				  </li>
                  @endguest
                  @auth
                  <li class="mr-3">
					<a class="inline-block text-gray-200 no-underline hover:text-gray-400 hover:text-underline py-2 px-2" href="/admin/game">Add Game</a>
				  </li>
                  <li class="mr-3">
					<a class="inline-block text-gray-200 no-underline hover:text-gray-400 hover:text-underline py-2 px-2" href="/signout">Log Out</a>
				  </li>
                  @endauth
				</ul>
			</div>
        </div>
    </nav>
</html>