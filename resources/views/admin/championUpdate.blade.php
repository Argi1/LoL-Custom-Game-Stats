<!DOCTYPE html>
<html>

<head>
    <title>Update champion list</title>
</head>
@include('head')

<body class="antialiased">
    <div class="p-5 pt-24">
        <div class="flex flex-col md:flex-row">
            <div class="flex-1 flex flex-col md:flex-row justify-center">
                <form method="post">
                    @csrf
                    <input type="submit" name="submitUpdateRequest" value="Update champion list"
                        class="text-sm  mx-2 w-40  focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer hover:bg-red-600 hover:text-rose-100 bg-rose-100 text-red-600 border duration-200 ease-in-out border-red-600 transition" />
                </form>
            </div>
        </div>
    </div>
</body>

</html>