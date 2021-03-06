<!DOCTYPE html>
<html>

<head>
    <title>Custom Game Data</title>
</head>
@include('head')

<body class="antialiased">
    <div class="flex h-screen items-center justify-center">
        <div class="grid w-7/12 m-auto">
            @include('searchBar')

            @if (session('success'))
            <div class="alert alert-danger w-auto m-auto mt-2">
                {{ session('success') }}
            </div>
            @endif
        </div>
    </div>   
</body>

</html>