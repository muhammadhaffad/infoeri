@extends('layouts.master')
@section('title', 'Event')
@section('content')
<div class="container max-w-full items-center">
    @include('layouts.navbar')
    @include('layouts.header')
    <div class="container mx-auto px-36" id="content">
        <div id="kategori-1" class="pb-10">
            <div class="header flex justify-between items-center pb-7">
                <div class="title">
                    @if(isset($category))
                    <h2 class="text-3xl font-bold">{{implode(', ', $category->pluck('name')->toArray())}}</h2>
                    <p class="text-sm ">Temukan event di kategori {{implode(', ', $category->pluck('name')->toArray())}}</p>
                    @endif
                </div>
            </div>
            <div class="card-wrapper flex flex-wrap mb-10 -mx-4">
                @foreach($events as $event)
                <div class="p-4 w-1/2">
                    <div id="event-card" class="card-event-horizontal">
                        <img src="{{ Storage::url($event->posters()->first()->poster) }}" class="card-event-horizontal-image">
                        <div id="konten" class="card-event-horizontal-content">
                            <div class="card-event-horizontal-date-badge">
                                <h2 class="font-bold text-xl">{{date("d", strtotime(explode(' ', $event->eventstart)[0]))}}</h2>
                                <p class="text-sm">{{date("M", strtotime(explode(' ', $event->eventstart)[0]))}}</p>
                            </div>
                            <h5 class="font-bold text-xl mb-2 truncate">{{$event->title}}</h5>
                            @if($event->type_id == 1)
                            <div class="label-event text-xs flex items-center gap-1 font-bold mb-3">
                                <p class="flex items-center bg-red-500 w-min p-1 rounded-l-md text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg> ONLINE
                                </p>
                                <p class="text-red-500">Event</p>
                            </div>
                            @else
                            <div class="label-event text-xs flex items-center gap-1 font-bold mb-3">
                                <p class="flex items-center bg-green-500 w-min p-1 rounded-l-md text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                    </svg> OFFLINE
                                </p>
                                <p class="text-green-500">Event</p>
                            </div>
                            @endif
                            <p class="flex items-center mb-4 gap-1 text-xs ">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                </svg>
                                {{$event->address}}
                            </p>
                            <a href="{{route('detail_event', ['id'=>$event->id])}}" type="submit" class="card-event-horizontal-button mt-2 mb-5">Lihat Event</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{$events->appends($_GET)->links()}}
        </div>
    </div>
    <div id="footer" class="mt-7">
        @include('layouts.footer')
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
            modal.style.display = "flex";
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
    @endsection