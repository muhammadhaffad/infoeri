@extends('layouts.master')
@section('title', 'Post Event')

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
                            <label for="poster" class="flex items-center gap-1 @error('images') text-red-500 @enderror">
                                @error('images')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @enderror
                                Event poster</label>
                            <div id="poster" class="h-96 flex bg-indigo-100 rounded-2xl cursor-pointer items-center justify-center hover:shadow-inner overflow-hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 absolute z-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                </svg>
                                <img id="poster-gambar" class="h-full opacity-40">
                                <input type="file" name="images[]" class="h-96 absolute opacity-0" accept="image/*" onchange="poster(event)" required>
                            </div>
                        </div>
                    </div>
                    <div class="w-2/3">
                        <div class="flex gap-2">
                            <div class="mb-7 w-2/4">
                                <label for="title" class="flex items-center gap-1 @error('event_title') text-red-500 @enderror">
                                    @error('event_title')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @enderror
                                    Nama Event</label>
                                <input type="text" value="{{ old('event_title') }}" placeholder="Tulis nama event kamu..." class="infoeri-form" name="event_title" id="title" required autofocus>
                            </div>
                            <div class="mb-7 w-1/4">
                                <label for="tipe" class="flex items-center gap-1 @error('event_type') text-red-500 @enderror">
                                    @error('event_type')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @enderror
                                    Jenis Event
                                </label>
                                <select type="select" class="infoeri-form" name="event_type">
                                    <option value="1">Online</option>
                                    <option value="2">Offline</option>
                                </select>
                            </div>
                            <div class="mb-7 w-1/4">
                                <label for="kategori" class="flex items-center gap-1 @error('event_categories') text-red-500 @enderror">
                                    @error('event_categories')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    @enderror
                                    Kategori Event</label>
                                <div class="infoeri-button" id="kategori">
                                    Kategori
                                </div>
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
                                        use App\Models\Category;
                                        $cats = new Category;
                                        @endphp
                                        @foreach($cats->get() as $cat)
                                        <div class="modal-category-item">
                                            <input class="modal-category-item-checkbox" type="checkbox" id="kategori{{$cat->id}}" name="event_categories[]" value="{{$cat->id}}">
                                            <label for="kategori{{$cat->id}}" class="modal-category-item-label">{{$cat->name}}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <label for="deskripsi" class="flex items-center gap-1 @error('event_description') text-red-500 @enderror">
                                @error('event_description')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @enderror
                                Deskripsi Event</label>
                            <textarea type="text" placeholder="Tulis deskripsi event kamu..." class="infoeri-form resize-none" name="event_description" id="deskripsi" rows="7" required>{{ old('event_description') }}</textarea>
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
                <div class="owl-carousel">
                    <div class="">
                        <div id="foto-tambahan1" class="overflow-hidden h-80 flex bg-indigo-100 rounded-2xl shadow-lg cursor-pointer items-center justify-center hover:shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 absolute z-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <img id="gambar1" class="h-full opacity-40">
                            <input type="file" name="images[]" class="h-full w-full opacity-0 absolute" accept="image/*" onchange="add_image1(event)">
                        </div>
                    </div>
                    <div class="">
                        <div id="foto-tambahan2" class="overflow-hidden h-80 flex bg-indigo-100 rounded-2xl shadow-lg cursor-pointer items-center justify-center hover:shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 absolute z-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <img id="gambar2" class="h-full opacity-40">
                            <input type="file" name="images[]" class="h-full w-full opacity-0 absolute" accept="image/*" onchange="add_image2(event)">
                        </div>
                    </div>
                    <div class="">
                        <div id="foto-tambahan3" class="overflow-hidden h-80 flex bg-indigo-100 rounded-2xl shadow-lg cursor-pointer items-center justify-center hover:shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 absolute z-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <img id="gambar3" class="h-full opacity-40">
                            <input type="file" name="images[]" class="h-full w-full opacity-0 absolute" accept="image/*" onchange="add_image3(event)">
                        </div>
                    </div>
                    <div class="">
                        <div id="foto-tambahan4" class="overflow-hidden h-80 flex bg-indigo-100 rounded-2xl shadow-lg cursor-pointer items-center justify-center hover:shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 absolute z-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <img id="gambar4" class="h-full opacity-40">
                            <input type="file" name="images[]" class="h-full w-full opacity-0 absolute" accept="image/*" onchange="add_image4(event)">
                        </div>
                    </div>
                    <div class="">
                        <div id="foto-tambahan5" class="overflow-hidden h-80 flex bg-indigo-100 rounded-2xl shadow-lg cursor-pointer items-center justify-center hover:shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-800 absolute z-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                            </svg>
                            <img id="gambar5" class="h-full opacity-40">
                            <input type="file" name="images[]" class="h-full w-full opacity-0 absolute" accept="image/*" onchange="add_image5(event)">
                        </div>
                    </div>
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
                            <label for="mulai-event" class="flex items-center gap-1 @error('event_start_date') text-red-500 @enderror">
                                @error('event_start_date')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @enderror
                                Tanggal mulai acara</label>
                            <input type="date" value="{{ old('event_start_date') }}" placeholder="Tulis deskripsi event kamu..." class="infoeri-form cursor-pointer resize-none" name="event_start_date" id="mulai-event" rows="7" required>
                        </div>
                        <div class="">
                            <label for="mulai-event" class="flex items-center gap-1 @error('event_start_time') text-red-500 @enderror">
                                @error('event_start_time')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @enderror
                                Waktu mulai acara</label>
                            <input type="time" value="{{ old('event_start_time') }}" placeholder="Tulis deskripsi event kamu..." class="infoeri-form cursor-pointer resize-none" name="event_start_time" id="mulai-event" rows="7" required>
                        </div>
                    </div>
                    <div class="block w-1/2 gap-2 p-5 rounded-lg border-2">
                        <div class="font-bold">Sampai dengan</div>
                        <div class="">
                            <label for="selesai-event" class="flex items-center gap-1 @error('event_end_date') text-red-500 @enderror">
                                @error('event_end_date')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @enderror
                                Tanggal selesai acara</label>
                            <input type="date" value="{{ old('event_end_date') }}" placeholder="Tulis deskripsi event kamu..." class="infoeri-form cursor-pointer resize-none" name="event_end_date" id="selesai-event" rows="7" required>
                        </div>
                        <div class="">
                            <label for="selesai-event" class="flex items-center gap-1 @error('event_end_time') text-red-500 @enderror">
                                @error('event_end_time')
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @enderror
                                Waktu selesai acara</label>
                            <input type="time" value="{{ old('event_end_time') }}" placeholder="Tulis deskripsi event kamu..." class="infoeri-form cursor-pointer resize-none" name="event_end_time" id="selesai-event" rows="7" required>
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
                    <label for="kontak" class="flex items-center gap-1 @error('contact') text-red-500 @enderror">
                        @error('contact')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Kontak</label>
                    <input type="text" value="{{ old('contact') }}" placeholder="Tulis kontak yang dapat dihubungi..." class="infoeri-form" name="contact" id="kontak" required>
                </div>
                <div class="mb-7">
                    <label for="alamat" class="flex items-center gap-1 @error('address') text-red-500 @enderror">
                        @error('address')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Alamat</label>
                    <input type="text" value="{{ old('address') }}" placeholder="Tulis alamat acara..." class="infoeri-form" name="address" id="alamat" required>
                </div>
                <div class="mb-7">
                    <label for="link" class="flex items-center gap-1 @error('link') text-red-500 @enderror">
                        @error('link')
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        @enderror
                        Link Pendaftaran</label>
                    <input type="text" value="{{ old('link') }}" placeholder="Isi link pendaftaran event..." class="infoeri-form" name="link" id="link" required>
                </div>
            </div>
            <hr>
            <button class="bg-indigo-600 py-4 px-20 rounded-xl font-bold text-white mt-6 mb-20 hover:bg-indigo-100 hover:shadow-inner hover:text-indigo-500">Buat Event!</button>
        </form>
    </div>
    <div id="footer"></div>
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
    var poster = function(event) {
        var output = document.getElementById('poster-gambar');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    var add_image1 = function(event) {
        var output = document.getElementById('gambar1');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    var add_image2 = function(event) {
        var output = document.getElementById('gambar2');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    var add_image3 = function(event) {
        var output = document.getElementById('gambar3');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    var add_image4 = function(event) {
        var output = document.getElementById('gambar4');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    var add_image5 = function(event) {
        var output = document.getElementById('gambar5');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
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
<div id="footer" class="mt-7">
    @include('layouts.footer')
</div>
@endsection