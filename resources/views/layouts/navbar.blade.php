<div class="flex justify-between items-center h-16 bg-white shadow-md px-36 fixed w-full z-10" id="navbar">
    <div class="flex">
        <div class="block w-full text-indigo-500 font-bold text-4xl ">
            <a style="font-family: 'Montserrat Alternates', sans-serif;" href="{{route('home')}}">!nfoeri</a>
        </div>
    </div>
    <div class="flex items-center text-gray-900 font-bold gap-2">
        <div class="block navbar-menu">
            <a href="{{route('home')}}">Home</a>
        </div>
        <div class="block navbar-menu">
            <a href="{{route('about_us')}}">About Us</a>
        </div>
        @auth
        <div class="block">
            <a href="{{route('add_event')}}" class="navbar-menu-btn">Post Event</a>
        </div>
        @endauth
        <div class="flex-row">
            <button class="flex" onclick="myFunc(event)">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 hover:text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <script>
                function myFunc(event) {
                    var x = document.getElementById("dropdown");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    } else {
                        x.style.display = "none";
                    }
                }
            </script>
            @auth
            <div id="dropdown" class="absolute p-3 px-7 -ml-20 mt-3 rounded-md bg-indigo-100" style="display:none">
                <a class="block mb-2 hover:text-indigo-300" href="{{ route('profile') }}">Profile</a>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="block hover:text-indigo-300 font-bold">Logout</button>
                </form>
            </div>
            @endauth
            @guest
            <div id="dropdown" class="absolute p-3 px-7 -ml-20 mt-3 rounded-md bg-indigo-100" style="display:none">
                <a class="block mb-2 hover:text-indigo-300" href="{{ route('login') }}">Login</a>
                <a class="block hover:text-indigo-300" href="{{ route('register') }}">Register</a>
            </div>
            @endguest
        </div>
    </div>
</div>