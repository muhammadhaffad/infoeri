@extends('admin.layouts.master')
@section('style')
<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    .block-ellipsis {
        display: -webkit-box;
        max-width: 100%;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
</style>
@endsection
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4>Event</h4>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col" class="col-3">Nama event</th>
            <th scope="col" class="col-4">Deskripsi</th>
            <th scope="col" class="col-2">Kategori</th>
            <th scope="col" class="col-1">Penyelenggara</th>
            <th scope="col" class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($events->paginate(15) as $event)
        <tr>
            <td>{{$event->title}}</td>
            <td>
                <p class="block-ellipsis">
                    {{$event->descriptioin}}
                </p>
            </td>
            <td>{{implode(', ',$event->categories()->get()->pluck('name')->toArray())}}</td>
            <td>{{$event->user()->first()->username}}</td>
            <td>
                <div class="d-flex">
                    <button type="button" class="show-detail btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" event-id="{{$event->id}}">
                        Lihat detail
                    </button>
                    <form action="event/delete" method="post">
                        @csrf
                        <input hidden type="text" name="event_id" value="{{$event->id}}">
                        <button type="submit" class="btn btn-danger">
                            <span data-feather="trash-2"></span>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h4>Kategori</h4>
</div>
<div class="col-4">
    <table class="table">
        <thead>
            <tr class="align-middle">
                <th scope="col" class="col">Kategori</th>
                <th scope="col" class="col">
                    <div class="d-flex justify-content-between align-items-baseline">
                        Aksi
                        <button class="create-category btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreateCategory">Tambah</button>
                    </div>
                </th>
            </tr>
        </thead>
        <tbody>
            @php
            use App\Models\Category;
            $cats = new Category;
            @endphp
            @foreach($cats->get() as $category)
            <tr>
                <td id="cat_name">{{$category->name}}</td>
                <td>
                    <div class="d-flex">
                        <button type="button" class="show-detail-category btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#modalCategory" category-id="{{$category->id}}" category-name="{{$category->name}}">
                            Ubah
                        </button>
                        <form action="category/delete" method="post">
                            @csrf
                            <input hidden type="text" name="category_id" value="{{$category->id}}">
                            <button type="submit" class="btn btn-danger">
                                <span data-feather="trash-2"></span>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="modal fade" id="modalCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="category" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCategoryLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input hidden id="category_id" name="category_id" type="text">
                    <label for="category_name" class="form-label">Nama kategori</label>
                    <input type="text" class="form-control" name="category_name" id="category_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCreateCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCreateCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="category/create" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCreateCategoryLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input hidden id="category_id" name="category_id" type="text">
                    <label for="category_name" class="form-label">Nama kategori</label>
                    <input type="text" class="form-control" name="category_name" id="category_name">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <form action="" id="detail_event" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="event_id" name="event_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">Poster utama</label>
                                <div class="row px-2">
                                    <div class="col-2 px-1">
                                        <img id="image1" src="https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg" class="rounded" style="width: 100%; height: 80px; object-fit: cover">
                                    </div>
                                </div>
                                <label class="form-label">Gambar tambahan</label>
                                <div class="row px-2">
                                    <div class="col-2 px-1">
                                        <img id="image2" src="https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg" class="rounded" style="width: 100%; height: 80px; object-fit: cover">
                                    </div>
                                    <div class="col-2 px-1">
                                        <img id="image3" src="https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg" class="rounded" style="width: 100%; height: 80px; object-fit: cover">
                                    </div>
                                    <div class="col-2 px-1">
                                        <img id="image4" src="https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg" class="rounded" style="width: 100%; height: 80px; object-fit: cover">
                                    </div>
                                    <div class="col-2 px-1">
                                        <img id="image5" src="https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg" class="rounded" style="width: 100%; height: 80px; object-fit: cover">
                                    </div>
                                    <div class="col-2 px-1">
                                        <img id="image6" src="https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg" class="rounded" style="width: 100%; height: 80px; object-fit: cover">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="row">
                                    <div class="col-8">
                                        <label for="event_title" class="form-label">Nama event</label>
                                        <input type="text" name="event_title" class="form-control" id="event_title">
                                    </div>
                                    <div class="col-4">
                                        <label for="" class="form-label">Kategori</label>
                                        <a class="btn btn-secondary w-100" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                            Kategori
                                        </a>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                            @php
                                            $cats = new Category;
                                            @endphp
                                            @foreach($cats->get() as $cat)
                                            <li>
                                                <a class="dropdown-item"><input type="checkbox" name="event_categories[]" class="form-check-input" value="{{$cat->id}}" id="{{$cat->name}}"> <label for="{{$cat->name}}"> {{$cat->name}}</label></a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="event_description" class="form-label">Deskripsi event</label>
                                <textarea class="form-control" name="event_description" id="event_description" rows="3" style="resize: none;"></textarea>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <label class="form-label">Mulai event</label>
                                    <input type="date" class="form-control mb-2" name="event_start_date" id="event_start_date">
                                    <input type="time" class="form-control" name="event_start_time" id="event_start_time">
                                </div>
                                <div class="col-6">
                                    <label class="form-label">Event selesai</label>
                                    <input type="date" class="form-control mb-2" name="event_end_date" id="event_end_date">
                                    <input type="time" class="form-control" name="event_end_time" id="event_end_time">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="contact" class="form-label">Kontak</label>
                                <input name="contact" type="text" class="form-control" id="contact">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat</label>
                                <input name="address" type="text" class="form-control" id="address">
                            </div>
                            <div class="mb-3">
                                <label for="link" class="form-label">Link</label>
                                <input name="link" type="text" class="form-control" id="link">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Poster utama</label>
                                <input name="poster" class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="mb-3">
                                <label for="formFileSm" class="form-label">Gambar tambahan</label>
                                <input name="image[]" class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="mb-3">
                                <input name="image[]" class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="mb-3">
                                <input name="image[]" class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="mb-3">
                                <input name="image[]" class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                            <div class="mb-3">
                                <input name="image[]" class="form-control form-control-sm" id="formFileSm" type="file">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
@endsection
@section('js')
<script>
    $('.show-detail-category').click(function() {
        let name = $(this).attr('category-name');
        let id = $(this).attr('category-id');
        $('#category_id').attr('value', id);
        $('#category_name').attr('value', name);
    });
</script>
<script>
    function free_modal() {
        for (let i = 1; i <= 6; i++) {
            $('#image' + i).attr('src', 'https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg');
        }
        $('input:checkbox').removeAttr('checked');
    }

    $('.show-detail').click(function(event) {
        free_modal();
        var id = $(this).attr('event-id');
        $.getJSON('http://127.0.0.1:8000/admin/api/event/' + id, function(data) {
            $('#event_id').attr('value', id);
            let posters = data['posters'];
            for (let i = 0; i < posters.length; i++) {
                let poster = posters[i]['poster'];
                $('#image' + (i + 1)).attr('src', 'http://127.0.0.1:8000/storage/' + poster);
            }
            let categories = data['categories'];
            for (let i = 0; i < categories.length; i++) {
                const category = categories[i]['name'];
                $('#' + category).attr('checked', true);
            }
            let event = data['event'];
            $('#event_title').attr('value', event['title'])
            $('#event_description').val(event['descriptioin'])
            let event_start_datetime = event['eventstart'].split(" ");
            $('#event_start_date').attr('value', event_start_datetime[0])
            $('#event_start_time').attr('value', event_start_datetime[1])
            let event_end_datetime = event['eventend'].split(" ");
            $('#event_end_date').attr('value', event_end_datetime[0])
            $('#event_end_time').attr('value', event_end_datetime[1])
            $('#contact').attr('value', event['contact']);
            $('#address').attr('value', event['address']);
            $('#link').attr('value', event['link']);
        });
    });
</script>
@endsection