<!DOCTYPE html>
<html>
<nav class="bg-zinc-800 p-2 mt-0 fixed w-full z-51 top-0 h-26 lg:h-16 min-h-fit">
    <div class="container mx-auto flex flex-wrap items-center">
        <div class="flex w-1/2 sm:w-full lg:w-1/2 sm:justify-center lg:justify-start text-white font-extrabold">
            <a class="text-gray-200 no-underline hover:text-gray-200 hover:no-underline" href="/">
                <span class="text-2xl pl-2">Eesti Custom Lobby</span>
            </a>
        </div>
        <div class="sm:flex w-full pt-2 content-center justify-between lg:w-1/2 lg:justify-end hidden">
            <ul class="list-reset flex justify-between flex-1 lg:flex-none items-center font-semibold">
                <li class="mr-3">
                    <a class="inline-block py-2 px-2 text-gray-200 no-underline hover:text-gray-400" href="/champion">Champions</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-2 px-2" href="/summoner">Summoners</a>
                </li>
                <li class="mr-3">
                    <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-2 px-2" href="/matches">Match
                        History</a>
                </li>
                @guest
                    <li class="mr-3">
                        <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-2 px-2" href="/signin">Sign
                            In</a>
                    </li>
                @endguest
                @auth
                    <li class="mr-3">
                        <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-2 px-2"
                           href="/admin/game">Add Game</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-2 px-2"
                           href="/signout">Log Out</a>
                    </li>
                @endauth
                <li class="mr-3">
                    <button class="inline-block text-gray-200 hover:text-gray-400 py-2 px-2 search-button">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                             stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                            <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                </li>
            </ul>
        </div>
        <div class="sm:hidden w-1/2 flex justify-end">
            <button class="outline-none mobile-menu-button">
                <svg class=" w-10 h-10 text-gray-200 hover:text-gray-400 "
                     x-show="!showMenu"
                     fill="none"
                     stroke-linecap="round"
                     stroke-linejoin="round"
                     stroke-width="2"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        <div class="hidden nav-search-bar grow justify-end">
            <div class="bg-zinc-800 p-3 rounded-b-lg w-min">
                @include('searchBarHeader')
            </div>
        </div>
    </div>
</nav>

<div class="hidden mobile-menu mt-14 w-72 h-full absolute bg-zinc-900 z-50">
    <ul class="relative text-lg font-semibold">
        <li class="mt-4 ml-3 w-2/3">
            @include('searchBarHeader')
        </li>
        <li>
            <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-3 px-3"
               href="/champion">Champions</a>
        </li>
        <li>
            <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-3 px-3"
               href="/summoner">Summoners</a>
        </li>
        <li>
            <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-3 px-3" href="/matches">Match
                History</a>
        </li>
        @guest
            <li>
                <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-3 px-3" href="/signin">Sign
                    In</a>
            </li>
        @endguest
        @auth
            <li>
                <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-3 px-3" href="/admin/game">Add
                    Game</a>
            </li>
            <li>
                <a class="inline-block text-gray-200 no-underline hover:text-gray-400 py-3 px-3" href="/signout">Log
                    Out</a>
            </li>
        @endauth
    </ul>
</div>
<script>
    const searchBtn = document.querySelector("button.search-button");
    const navSearchBar = document.querySelector(".nav-search-bar");

    const menuBtn = document.querySelector("button.mobile-menu-button");
    const menu = document.querySelector(".mobile-menu");

    menuBtn.addEventListener("click", () => {
        menu.classList.toggle("hidden");
    });

    searchBtn.addEventListener("click", () => {
        navSearchBar.classList.toggle("hidden");
        navSearchBar.classList.toggle("flex");
    });
    window.onresize = function () {
        menu.classList.add("hidden");
        navSearchBar.classList.add("hidden");
        navSearchBar.classList.remove("flex");
    };
</script>
</html>
