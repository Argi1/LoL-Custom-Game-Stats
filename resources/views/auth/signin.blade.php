<!DOCTYPE html>
<html>

<head>
    <title>Sign in</title>
</head>
@include('head')

<body>
    <div class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center pt-24">
                <div class="col-md-4">
                    <div class="card bg-zinc-900 rounded-lg shadow-xl text-gray-400">
                        <div class="card-body">
                            <form method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <input type="text" placeholder="Name" id="name" class="text-gray-400 focus:text-gray-400 form-control bg-zinc-900 focus:bg-zinc-900" name="name"
                                        required autofocus>
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>

                                <div class="form-group mb-3">
                                    <input type="password" placeholder="Password" id="password" class="text-gray-400 focus:text-gray-400 form-control bg-zinc-900 focus:bg-zinc-900"
                                        name="password" required>
                                    @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                    @endif
                                </div>
                                <div class="d-grid mx-auto">
                                    <button type="submit" class="btn btn-dark btn-block">Sign in</button>
                                </div>
                            </form>
                            @if (session('success'))
                                <div class="alert alert-danger mt-2">
                                    {{ session('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>