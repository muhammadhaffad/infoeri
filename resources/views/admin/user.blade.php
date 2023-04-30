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
            <th scope="col" class="col-4">Nama lengkap</th>
            <th scope="col" class="col-2">Email</th>
            <th scope="col" class="col-2">Nomor telepon</th>
            <th scope="col" class="col-2">Username</th>
            <th scope="col" class="col-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users->paginate(15) as $user)
        @if($user->role !== 'admin')
        <tr>
            <td>{{$user->firstname.' '.$user->lastname}}</td>
            <td>
                <p class="block-ellipsis">
                    {{$user->email}}
                </p>
            </td>
            <td>{{$user->phone}}</td>
            <td>{{$user->username}}</td>
            <td>
                <div class="d-flex">
                    <button type="button" class="show-detail btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop" user-id="{{$user->id}}">
                        Lihat detail
                    </button>
                    <form action="user/delete" method="post">
                        @csrf
                        <input hidden type="text" name="user_id" value="{{$user->id}}">
                        <button type="submit" class="btn btn-danger">
                            <span data-feather="trash-2"></span>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {!! $users->paginate(15)->links() !!}
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="" id="detail_event" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="user_id" name="user_id" value="">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Detail user</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col">
                                        <label for="user_firstname" class="form-label">Nama depan</label>
                                        <input type="text" name="user_firstname" class="form-control" id="user_firstname">
                                    </div>
                                    <div class="col">
                                        <label for="user_lastname" class="form-label">Nama belakang</label>
                                        <input type="text" name="user_lastname" class="form-control" id="user_lastname">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="user_email" class="form-label">Email</label>
                        <input type="email" name="user_email" class="form-control" id="user_email">
                    </div>
                    <div class="mb-3">
                        <label for="user_password" class="form-label">Password</label>
                        <input type="password" placeholder="Ganti password" name="user_password" class="form-control" id="user_password">
                    </div>
                    <div class="mb-3">
                        <label for="user_phone" class="form-label">Nomor telepon</label>
                        <input type="text" name="user_phone" class="form-control" id="user_phone">
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
    function free_modal() {
        for (let i = 1; i <= 6; i++) {
            $('#image' + i).attr('src', 'https://st4.depositphotos.com/14953852/22772/v/600/depositphotos_227725020-stock-illustration-no-image-available-icon-flat.jpg');
        }
        $('input:checkbox').removeAttr('checked');
    }

    $('.show-detail').click(function(event) {
        free_modal();
        var id = $(this).attr('user-id');
        $.getJSON('http://127.0.0.1:8000/admin/api/user/' + id, function(data) {
            $('#user_id').attr('value', data['user']['id']);
            $('#user_firstname').attr('value', data['user']['firstname']);
            $('#user_lastname').attr('value', data['user']['lastname']);
            $('#user_email').attr('value', data['user']['email']);
            $('#user_phone').attr('value', data['user']['phone']);
        });
    });
</script>
@endsection