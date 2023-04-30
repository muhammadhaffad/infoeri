@extends('layouts.master')
@section('title', 'Home')

@section('content')
<div class="container max-w-full items-center">
    @include('layouts.navbar')
    @include('layouts.header')
    <div class="container mx-auto px-36 min-h-screen" id="content">
        @foreach($cats->get() as $cat)
        @php
        $categories_event = $events->categories_event([$cat->id]);
        @endphp
        <div id="kategori-1" class="pb-10">
            <div class="header flex justify-between items-center pb-7">
                <div class="title">
                    <h2 class="text-3xl font-bold">{{$cat->name}}</h2>
                    <p class="text-sm ">Temukan event di kategori {{$cat->name}}</p>
                </div>
                <a href="{{route('list_event').'?category[]='.$cat->name}}" class="see-all font-bold flex items-center gap-1">
                    Lihat semua <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
            <div id="card-container" class="owl-carousel owl-theme">
                @foreach($categories_event->get() as $event)
                <div id="card-event" class="card-event-vertical">
                    <img src="{{ Storage::url($event->posters()->first()->poster) }}" class="card-event-vertical-image">
                    <div id="date" class="card-event-vertical-date-badge">
                        <h5 class="font-bold text-xl">{{date("d", strtotime(explode(' ', $event->eventstart)[0]))}}</h5>
                        <p class="text-sm">{{date("M", strtotime(explode(' ', $event->eventstart)[0]))}}</p>
                    </div>
                    <div id="konten" class="card-event-vertical-content">
                        <h2 class="truncate text-lg font-bold">{{$event->title}}</h2>
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
                            <p class="flex items-center bg-indigo-500 w-min p-1 rounded-l-md text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                                </svg> OFFLINE
                            </p>
                            <p class="text-indigo-500">Event</p>
                        </div>
                        @endif
                        <p class="flex items-center gap-1 text-xs text-indigo-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                            {{$event->address}}
                        </p>
                    </div>
                    <a href="{{route('detail_event', ['id'=>$event->id])}}" type="submit" class="card-event-vertical-button">Lihat Event</a>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
        <div id="lainnya" class="w-48 mb-14 mt-5 mx-auto infoeri-button">
            Lihat kategori lainnya
        </div>
        <div id="modal2" class="hidden modal-category-container">
            <div id="modal-konten" class="modal-category-content w-1/3">
                <form action="/event" method="get">
                    <span id="close2" class="text-2xl text-gray-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </span>
                    <div class="modal-category-item-container h-64 mt-4">
                        @foreach($cats->get() as $cat)
                        <div class="modal-category-item">
                            <input class="modal-category-item-checkbox" type="checkbox" id="kategori_{{$cat->id}}" name="category[]" value="{{$cat->name}}">
                            <label class="modal-category-item-label" for="kategori_{{$cat->id}}">{{$cat->name}}</label>
                        </div>
                        @endforeach
                    </div>
                    <div class="w-full flex justify-end mt-4">
                        <button class="infoeri-button px-10">Proses</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="footer">
        @include('layouts.footer')
    </div>
</div>
<script>
    // Get the modal
    {
        let modal = document.getElementById("modal");

        // Get the button that opens the modal
        let btn = document.getElementById("btn-kategori");

        // Get the <span> element that closes the modal
        let span = document.getElementById("close");

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
    }
</script>
<script>
    {
        let modal = document.getElementById("modal2");

        // Get the button that opens the modal
        let btn = document.getElementById("lainnya");

        // Get the <span> element that closes the modal
        let span = document.getElementById("close2");

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "flex";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    }
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