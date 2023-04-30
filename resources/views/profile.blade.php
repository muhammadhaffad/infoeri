@extends('layouts.master')
@section('title', $profile->username)
@section('content')
<div class="container max-w-full items-center">
    @include('layouts.navbar')
    <div id="content" class="container mx-auto px-36 min-h-screen pt-28">
        <div id="profile" class="mb-10">
            <h5 class="font-bold text-3xl">{{ $profile->firstname }}</h5>
            <p class="text-lg mb-4">{{'@'.$profile->firstname}}</p>
            <!-- <a href="" class="infoeri-button">Ubah Profil</a> -->
        </div>
        <div class="flex gap-2 mb-10 font-bold text-xl items-center w-56 mx-auto py-1 text-white bg-red-600 justify-center rounded-lg ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Event yang dibuat
        </div>
        @foreach($profile->events()->paginate(10) as $event)
        <div id="event-user" class="flex w-full mb-10">
            <img src="{{ Storage::url($event->posters()->first()->poster); }}" class="w-1/5 h-72 rounded-xl">
            <div class="flex-row pl-4 w-3/5">
                <h1 class="font-bold text-2xl">{{ $event->title }}</h1>
                <p class="text-sm mb-3">{{ date("d F Y", strtotime(explode(' ', $event->eventstart)[0])) }} to {{ date("d F Y", strtotime(explode(' ', $event->eventend)[0])) }}</p>
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
                <div class="label-event text-xs flex items-center gap-1 font-bold">
                    <p class="flex items-center bg-indigo-500 w-min p-1 rounded-l-md text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                        </svg> OFFLINE
                    </p>
                    <p class="text-indigo-500">Event</p>
                </div>
                @endif
                <div class="event-time flex text-sm items-center gap-1 mt-2 mb-5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{explode(' ',$event->eventstart)[1]}} to {{explode(' ',$event->eventend)[1]}}
                </div>
                <a href="{{route('detail_event', ['id' => $event->id])}}" class="infoeri-button">Lihat event</a>
            </div>
            <div class="w-1/5">
                <a href="{{route('update_event', ['id' => $event->id])}}" class="flex w-min ml-auto mr-0 infoeri-button bg-green-600 hover:text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg> Edit
                </a>
            </div>
        </div>
        @endforeach
        {{$profile->events()->paginate(10)->links()}}
    </div>
    <div id="footer" class="mt-7">
        @include('layouts.footer')
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "lengthChange": false,
            "info": false
        });
    });
</script>
@endsection