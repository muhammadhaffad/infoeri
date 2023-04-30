@extends('layouts.master')
@section('title', $event->title)
@section('content')

<body class="">
    <div class="container max-w-full items-center">
        @include('layouts.navbar')
        <div id="content" class="container mx-auto px-36 min-h-screen pt-28">
            <div id="detail-1" class="flex w-2/3">
                <img src="{{ Storage::url($event->posters()->first()->poster); }}" class="w-52 rounded-xl">
                <div class="flex-row pl-4">
                    <div id="user-profile" class="flex items-start mb-2">
                        <img src="https://picsum.photos/400/400/?random" class="w-12 rounded-full">
                        <div class="flex-row pl-2">
                            <h5 class="font-bold text-lg">{{ $event->user()->first()->firstname." ".$event->user()->first()->lastname }}</h5>
                            <p class="-my-1">{{ '@'.$event->user()->first()->username }}</p>
                        </div>
                    </div>
                    <p class="text-sm">{{ date("d F Y", strtotime(explode(' ', $event->eventstart)[0])) }} to {{ date("d F Y", strtotime(explode(' ', $event->eventend)[0])) }}</p>
                    <h1 class="font-bold text-2xl mb-3">{{$event->title}}</h1>
                    @if($event->type_id === 1)
                    <div class="label-event text-xs flex items-center gap-1 font-bold">
                        <p class="flex items-center bg-red-500 w-min p-1 rounded-l-md text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                            </svg> ONLINE
                        </p>
                        <p class="text-red-500">Event</p>
                    </div>
                    @else
                    <div class="event-location flex gap-1 text-xs items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        {{ $event->address }}
                    </div>
                    @endif
                    <div class="event-time flex text-sm items-center gap-1 mt-10 mb-5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ explode(' ', $event->eventstart)[1] }} to {{explode(' ', $event->eventend)[1] }}
                    </div>
                    <div class="flex items-end">
                        <a href="{{ $event->link }}" class="bg-indigo-500 p-2 px-10 items-center rounded-xl font-bold text-white shadow-md hover:bg-indigo-100 hover:text-indigo-500 hover:shadow-inner">Daftar Sekarang</a>
                    </div>
                </div>
            </div>
            <div id="detail-2" class="mt-10 mb-20">
                <div class="flex gap-2 font-bold text-xl items-center w-40 mx-auto mb-2 py-1 text-indigo-600 shadow-inner bg-indigo-100 justify-center rounded-lg ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                    Detail Event
                </div>
                <div class="flex-row bg-gray-50 shadow-inner p-10 rounded-xl">
                    <h5 class="text-3xl font-bold mb-7">{{ $event->title }}</h5>
                    <div class="">
                        <div class="flex w-full gap-3">
                            @foreach($event->posters()->get() as $key=>$poster)
                            <img src="{{ Storage::url($poster->poster); }}" class="w-1/5 h-72 rounded-xl mb-5">
                            @endforeach
                        </div>
                        <p>
                            {{$event->descriptioin}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="footer" class="mt-7">
            @include('layouts.footer')
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("modal");

        // Get the button that opens the modal
        var btn = document.getElementById("btn-kategori");

        // Get the <span> element that closes the modal
        var span = document.getElementById("close");

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(e) {
            if (e.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    <script>
        // Get the modal
        var modal2 = document.getElementById("modal2");

        // Get the button that opens the modal
        var btn2 = document.getElementById("lainnya");

        // Get the <span> element that closes the modal
        var span2 = document.getElementById("close2");

        // When the user clicks the button, open the modal 
        btn2.onclick = function() {
            modal2.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span2.onclick = function() {
            modal2.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
    </script>
    <script>
        $('.owl-carousel').owlCarousel({
            loop: false,
            margin: 20,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 4
                }
            }
        })
    </script>
    @endsection