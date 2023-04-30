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
    @if($message = Session::get('success'))
    <script>
        alert('{{$message}}')
    </script>
    @endif
    <div class="container max-w-full min-h-screen flex justify-center items-center">
        <div class="flex-row">
        <a href="{{route('home')}}" style="font-family: 'Montserrat Alternates', sans-serif;" class="block text-indigo-600 font-bold text-5xl text-center mb-5" >!nfoeri</a>
            <form action="/register" method="post">
                @csrf
                <div class="flex gap-2">
                    <div class="mb-2">
                        <label for="firstname" class="flex items-center gap-1 @error('first_name') text-red-500 @enderror">
                            @error('first_name')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @enderror
                            Nama depan</label>
                        <input type="text" value="{{ old('first_name') }}" name="first_name" placeholder="Nama depan" class="block w-full rounded-xl border-0 shadow-inner bg-indigo-100" name="firstname" id="firstname" autofocus>
                    </div>
                    <div class="mb-2">
                        <label for="lastname" class="flex items-center gap-1 @error('last_name') text-red-500 @enderror">
                            @error('last_name')
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            @enderror
                            Nama belakang</label>
                        <input type="text" value="{{ old('last_name') }}" name="last_name" placeholder="Nama belakang" class="block w-full rounded-xl border-0 shadow-inner bg-indigo-100" name="lastname" id="lastname">
                    </div>
                </div>
                <div class="mb-2">
                    <label for="email" class="flex items-center gap-1 @error('email') text-red-500 @enderror">
                        @error('email')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Email</label>
                    <input type="text" value="{{ old('email') }}" name="email" placeholder="Email" class="block w-full rounded-xl border-0 shadow-inner bg-indigo-100" name="email" id="email">
                </div>
                <div class="mb-2">
                    <label for="username" class="flex items-center gap-1 @error('username') text-red-500 @enderror">
                        @error('username')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Username</label>
                    <input type="text" value="{{ old('username') }}" name="username" placeholder="Username" class="block w-full rounded-xl border-0 shadow-inner bg-indigo-100" name="username" id="username">
                </div>
                <div class="mb-2">
                    <label for="password" class="flex items-center gap-1 @error('password') text-red-500 @enderror">
                        @error('password')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Password</label>
                    <input type="password" name="password" placeholder="Password" class="block w-full rounded-xl border-0 shadow-inner bg-indigo-100" name="password" id="password">
                </div>
                <div class="mb-2">
                    <label for="phone" class="flex items-center gap-1 @error('phone_number') text-red-500 @enderror">
                        @error('phone_number')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        No. Telp</label>
                    <input type="text" value="{{ old('phone_number') }}" placeholder="+62" name="phone_number" class="block w-full rounded-xl border-0 shadow-inner bg-indigo-100" name="phone" id="phone">
                </div>
                <div class="flex w-full justify-end">
                    <button class=" font-bold text-white bg-indigo-600 hover:bg-indigo-100 hover:text-indigo-600 hover:shadow-inner py-2 px-16 my-4 rounded-xl w-min">Daftar</button>
                </div>
            </form>
            <p class="text-center">Sudah punya akun?, silahkan <a href="/login" class="text-indigo-500">Login</a></p>
        </div>
    </div>
</body>

</html>