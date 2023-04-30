@extends('layouts.master')
@section('title', 'Update Event')
@section('content')
@if ($message = Session::get('success'))
<script>
    alert('{{ $message }}')
</script>
@endif
<div class="container max-w-full items-center">
    @include('layouts.navbar')
    <div id="content" class="container mx-auto px-36 min-h-screen pt-28">
        <form action="" method="post" enctype="multipart/form-data">
            @csrf
            <div id="info-dasar" class="flex-row mb-7">
                <div class=" mb-10">
                    <h5 class="font-bold text-3xl">Tulis detail dasar Event kamu...</h5>
                    <p class="text-sm">Beri nama event kamu dan beri tahu peserta event mengapa mereka harus datang. Tambahkan detail yang menonjolkan apa yang membuatnya unik.</p>
                </div>
                <div class="flex items-stretch">
                    <div class="w-1/3 block mr-20">
                        <div class="">
                            <label for="poster" class="">Event poster</label>
                            <div id="poster" class="h-96 flex bg-indigo-100 rounded-2xl cursor-pointer items-center justify-center hover:shadow-inner overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 absolute z-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                <img src="{{ Storage::url($event->posters()->first()->poster) }}" id="poster-gambar" class="h-full opacity-40">
                                <input type="file" name="poster_event" class="h-96 absolute opacity-0" accept="image/*" onchange="add_poster(event)">
                                <input hidden type="text" value="{{$event->posters()->first()->poster}}" name="poster">
                            </div>
                        </div>
                    </div>
                    <div class="w-2/3">
                        <div class="flex gap-2">
                            <div class="mb-7 w-2/3">
                                <label for="title" class="flex gap-1 items-center @error('event_title') text-red-500 @enderror">
                                    @error('event_title')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @enderror
                                    Nama Event
                                </label>
                                <input value="{{ $event->title }}" type="text" placeholder="Tulis nama event kamu..." class="infoeri-form" name="event_title" id="title" required>
                            </div>
                            <div class="mb-7 w-1/3">
                                <label for="kategori" class="flex items-center gap-1 @error('event_categories') text-red-500 @enderror">
                                    @error('event_categories')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @enderror
                                    Kategori Event
                                </label>
                                <div class="infoeri-button" id="kategori">Pilih kategori event</div>
                            </div>
                            <div id="modal" class="hidden modal-category-container">
                                <div id="modal-konten" class="modal-category-content w-1/3">
                                    <span id="close" class="text-2xl text-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </span>
                                    <div class="modal-category-item-container h-64 mt-4">
                                        @php
                                        $categories = $event->categories()->get();
                                        $idx = 0; @endphp
                                        @foreach($cats as $cat)
                                        @if(@$categories[$idx]->id == $cat->id)
                                        <div class="modal-category-item">
                                            <input class="modal-category-item-checkbox" type="checkbox" id="kategori{{$cat->id}}" name="event_categories[]" value="{{$cat->id}}" checked>
                                            <label for="kategori{{$cat->id}}" class="modal-category-item-label">{{$cat->name}}</label>
                                        </div>
                                        @php $idx++; @endphp
                                        @else
                                        <div class="modal-category-item">
                                            <input class="modal-category-item-checkbox" type="checkbox" id="kategori{{$cat->id}}" name="event_categories[]" value="{{$cat->id}}">
                                            <label for="kategori{{$cat->id}}" class="modal-category-item-label">{{$cat->name}}</label>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label for="deskripsi" class="flex gap-1 items-center @error('event_description') text-red-500 @enderror">
                                @error('event_description')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @enderror
                                Deskripsi Event</label>
                            <textarea type="text" placeholder="Tulis deskripsi event kamu..." class="infoeri-form resize-none" name="event_description" id="deskripsi" rows="7" required>{{ $event->descriptioin }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div id="info-tambahan" class="flex-row mb-7">
                <hr>
                <div class="mt-10 mb-10">
                    <h5 class="font-bold text-3xl">Tambahkan Informasi tambahan...</h5>
                    <p class="text-sm">Upload beberapa foto lainnya untuk tambahan informasi pada event kamu.</p>
                </div>
                <label for="foto-tambahan">Foto lainnya...</label>
                @php $images = $event->posters()->get() @endphp
                <div class="owl-carousel">
                    @php $images = $event->posters()->get() @endphp
                    @for($i=0; $i < 5; $i++) <div class="">
                        <div id="foto-tambahan{{ $i+1 }}" class="overflow-hidden h-80 flex bg-indigo-100 rounded-2xl items-center justify-center hover:shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 absolute z-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <img src="{{ isset($images[$i+1]) ? Storage::url($images[$i+1]->poster) : '' }}" id="gambar{{ $i+1 }}" class="h-full opacity-40">
                            <input type="file" name="addition_image_{{$i}}" class="w-full opacity-0 absolute cursor-pointer" accept="image/*" onchange="add_image(event, {{ $i+1 }})">
                            <input hidden type="text" name="additional_poster_{{$i}}" value="{{ isset($images[$i+1]) ? $images[$i+1]->poster : '' }}">
                        </div>
                        <input type="hidden" name="remove_poster_{{ $i }}" id="remove_poster_{{ $i }}" value="">
                        <button class="@php echo isset($images[$i+1]) ? '' : 'hidden' @endphp bg-red-500 p-2 px-4 rounded-xl w-full mt-2 font-bold text-white hover:bg-red-100 hover:shadow-inner hover:text-red-500" onclick="remove_button(event, {{ $i }})" id="button_{{$i+1}}">Remove</button>
                </div>
                @endfor
            </div>
    </div>
    <div id="waktu-pelaksanaan" class="mb-7">
        <hr>
        <div class="mt-10 mb-10">
            <h5 class="font-bold text-3xl">Tulis Waktu Pelaksanaan...</h5>
            <p class="text-sm">Beritahu peserta kapan event kamu dilaksanakan...</p>
        </div>
        <div class="flex w-full gap-2">
            <div class="block w-1/2 gap-2 p-5 rounded-lg border-2">
                <div class="font-bold">Dari mulai</div>
                <div class="">
                    <label for="mulai-event" class="flex gap-1 items-center @error('event_start_date') text-red-500 @enderror">
                        @error('event_start_date')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Tanggal mulai acara
                    </label>
                    <input value="{{ explode(' ', $event->eventstart)[0] }}" type="date" placeholder="Tulis deskripsi event kamu..." class="infoeri-form cursor-pointer resize-none" name="event_start_date" id="mulai-event" rows="7" required>
                </div>
                <div class="">
                    <label for="mulai-event" class="flex gap-1 items-center @error('event_start_time') text-red-500 @enderror">
                        @error('event_start_time')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Waktu mulai acara</label>
                    <input value="{{ explode(' ', $event->eventstart)[1] }}" type="time" placeholder="Tulis deskripsi event kamu..." class="infoeri-form cursor-pointer resize-none" name="event_start_time" id="mulai-event" rows="7" required>
                </div>
            </div>
            <div class="block w-1/2 gap-2 p-5 rounded-lg border-2">
                <div class="font-bold">
                    Sampai dengan</div>
                <div class="">
                    <label for="selesai-event" class="flex gap-1 items-center @error('event_end_date') text-red-500 @enderror">
                        @error('event_end_date')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Tanggal selesai acara</label>
                    <input value="{{ explode(' ', $event->eventend)[0] }}" type="date" placeholder="Tulis deskripsi event kamu..." class="infoeri-form cursor-pointer resize-none" name="event_end_date" id="selesai-event" rows="7" required>
                </div>
                <div class="">
                    <label for="selesai-event" class="flex gap-1 items-center @error('event_end_time') text-red-500 @enderror">
                        @error('event_end_time')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Waktu selesai acara</label>
                    <input value="{{ explode(' ', $event->eventend)[1] }}" type="time" placeholder="Tulis deskripsi event kamu..." class="infoeri-form cursor-pointer resize-none" name="event_end_time" id="selesai-event" rows="7" required>
                </div>
            </div>
        </div>
    </div>
    <div id="kontak-lokasi" class="mb-7">
        <hr>
        <div class="mt-10 mb-10">
            <h5 class="font-bold text-3xl">Kontak dan Link Pendaftaran</h5>
            <p class="text-sm">Beritahu peserta mengenai kontak agar peserta dapat terhubung...</p>
        </div>
        <div class="mb-7">
            <label for="kontak" class="flex gap-1 items-center @error('contact') text-red-500 @enderror">
                @error('contact')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                @enderror
                Kontak</label>
            <input value="{{ $event->contact }}" type="text" placeholder="Tulis kontak yang dapat dihubungi..." class="infoeri-form" name="contact" id="kontak" required>
        </div>
        <div class="mb-7">
            <label for="alamat" class="flex gap-1 items-center @error('address') text-red-500 @enderror">
                @error('address')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                @enderror
                Alamat</label>
            <input value="{{$event->address}}" type="text" placeholder="Tulis alamat acara..." class="infoeri-form" name="address" id="alamat" required>
        </div>
        <div class="mb-7">
            <label for="link" class="flex gap-1 items-center @error('link') text-red-500 @enderror">
                @error('link')
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                @enderror
                Link Pendaftaran</label>
            <input value="{{$event->link}}" type="text" placeholder="Isi link pendaftaran event..." class="infoeri-form" name="link" id="link" required>
        </div>
    </div>
    <hr>
    <button class="bg-indigo-600 py-4 px-20 rounded-xl font-bold text-white mt-6 mb-20 hover:bg-indigo-100 hover:shadow-inner hover:text-indigo-500">Update Event!</button>
    </form>
</div>
<div id="footer" class="mt-7">
    @include('layouts.footer')
</div>
</div>
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
                items: 5
            }
        }
    })
</script>
<script>
    function add_poster(event) {
        let output = document.getElementById('poster-gambar');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
<script>
    function add_image(event, id) {
        let output = document.getElementById('gambar' + id);
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src);
        }
        document.getElementById('remove_poster_' + (id - 1)).value = '';
        let btn = document.getElementById('button_' + id);
        btn.style.display = 'block';
    }
</script>
<script>
    function remove_button(event, id) {
        event.preventDefault();
        document.getElementById('remove_poster_' + id).value = 'remove';
        document.getElementById('gambar' + (id + 1)).src = '';
        document.getElementById('button_' + (id + 1)).style.display = 'none';
    }
</script>
<script>
    {
        let modal = document.getElementById("modal");

        // Get the button that opens the modal
        let btn = document.getElementById("kategori");

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
@endsection