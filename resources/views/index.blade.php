<!DOCTYPE html>
<html>

<head>
    <title>Custom Game Data</title>
</head>
@include('head')

<body class="antialiased">
    <div class="flex h-screen items-center justify-center">
        <div class="grid w-7/12 m-auto">
            <div class="flex flex-nowrap">
                <form autocomplete="off" class="flex grow" method="post" action="/search" enctype="multipart/form-data">
                    @csrf
                    <input
                        class="grow py-2 px-3 rounded-lg border-1 border-purple-300 focus:outline-none focus:ring-2 bg-neutral-900 focus:bg-neutral-900"
                        type="text" list="champions" placeholder="Search for a Champion or Summoner" required
                        name="search" id="search" />

                    <button
                        class="py-2 w-10 ml-1 text-white bg-purple-500 hover:bg-purple-700 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 text-center inline-flex flex-none items-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        var route = "{{ url('autocomplete-search') }}";

        $('#search').typeahead({
            source: function (query, process) {
                return $.get(route, {
                    query: query
                }, function (data) {
                    return process(data);
                });
            }
        });
    </script>
</body>

</html>