<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@700&display=swap');
    </style>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <title>Home</title>
</head>

<body class="">
    @if($message = Session::get('status'))
    <script>
        alert('{{$message}}')
    </script>
    @endif
    <div class="container max-w-full min-h-screen flex justify-center items-center">
        <form action="/login" method="post">
            @csrf
            <div class="flex-row w-96">
                <a href="{{route('home')}}" style="font-family: 'Montserrat Alternates', sans-serif;" class="block text-indigo-600 font-bold text-5xl text-center mb-5" >!nfoeri</a>
                <div class="mb-2 ">
                    <label for="username">Username</label>
                    <input name="username" type="text" placeholder="Username" class="block w-full rounded-xl border-0 shadow-inner bg-indigo-100" name="username" id="username" autofocus>
                </div>
                <div class="mb-2">
                    <label for="password">Password</label>
                    <input name="password" type="password" placeholder="Password" class="block w-full rounded-xl border-0 shadow-inner bg-indigo-100" name="password" id="password">
                </div>
                <div class="flex w-full justify-end">
                    <button class=" font-bold text-white bg-indigo-600 hover:bg-indigo-100 hover:text-indigo-600 hover:shadow-inner py-2 px-16 my-4 rounded-xl w-min">Masuk</button>
                </div>
                <p class="text-center">Belum punya akun?, silahkan <a href="/register" class="text-indigo-500">Daftar</a></p>
            </div>
        </form>
    </div>
</body>

</html>