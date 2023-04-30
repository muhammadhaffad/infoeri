<div class="container mx-auto px-36 py-10 pt-24" id="header">
    <div class="flex items-center justify-between gap-5 pb-8">
        <a href="#" class="header-image">
            <img src="{{asset('images/header.jpeg')}}" class="block h-76 w-full" alt="">
        </a>
    </div>
    <div id="search" class="flex">
        <form action="/event" method="get" class="w-full flex">
            <div class="container w-3/5 p-2 rounded-2xl flex shadow-md items-center group hover:bg-indigo-100 hover:shadow-inner">
                <svg class=" ml-2 w-8 h-8 text-gray-400 group-hover:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <input type="text" name="search" placeholder="Cari disini..." class="w-3/4 border-0 focus:outline-none focus:ring-0 group-hover:bg-indigo-100">
            </div>
            <div id="btn-kategori" class="header-btn w-1/5 ml-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                </svg> Kategori
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
                            <input class="modal-category-item-checkbox" type="checkbox" id="kategori{{$cat->id}}" name="category[]" value="{{$cat->name}}">
                            <label class="modal-category-item-label" for="kategori{{$cat->id}}">{{$cat->name}}</label>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <input type="submit" value="Cari" class="header-search-btn w-1/5 ml-6 cursor-pointer">
        </form>
    </div>
</div>