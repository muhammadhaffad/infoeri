<div class="w-full h-60 bg-gray-900">
    <div class="flex w-3/4 mx-auto">
        <div class="w-1/2 text-white p-3">
            <div class="font-bold text-5xl mb-3" style="font-family: 'Montserrat Alternates', sans-serif;">!nfoeri</div>
            @auth
            <div class="block mb-3">
                <a href="{{route('profile')}}" class="text-sm">Profile</a>
            </div>
            <div class="block mb-3">
                <form action="/logout" method="post">
                    @csrf
                    <button class="text-sm">Logout</button>
                </form>
            </div>
            <div class="block mb-3">
                <a href="{{route('home')}}" class="text-sm">Home</a>
            </div>
            @endauth
            @guest
            <div class="block mb-3">
                <a href="{{route('login')}}" class="text-sm">Login</a>
            </div>
            <div class="block mb-3">
                <a href="{{route('register')}}" class="text-sm">Register</a>
            </div>
            <div class="block mb-3">
                <a href="{{route('home')}}" class="text-sm">Home</a>
            </div>
            @endguest

        </div>
        <div class="w-1/2 text-white p-3">
            <div class="font-bold text-2xl mb-3" style="font-family: 'Montserrat Alternates', sans-serif;">Contact Us</div>
            <div class="flex gap-2 mb-3 text-sm">
                <p>Email:</p>
                <div class="flex-row">
                    <p>18650095@student.uin-malang.ac.id</p>
                    <p>18650105@student.uin-malang.ac.id</p>
                </div>
            </div>

        </div>
    </div>
</div>