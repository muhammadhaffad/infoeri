@extends('layouts.master')
@section('title', 'About Us')

@section('content')
@include('layouts.navbar')
<div class="w-full">
    <div class="flex h-96 bg-gray-900 pt-16 overflow-hidden items-center justify-center">
        <div class="absolute text-white z-10 block justify-items-center">
            <div class="header text-8xl" style="font-family: 'Montserrat Alternates', sans-serif;">!nfoeri</div>
            <div class="font-bold text-center">Luas informasimu, Cerdas Pengalamanmu</div>
        </div>
        <img src="{{ asset('images/background.jpg') }}" alt="" class="opacity-50">
    </div>
    <div class="container mx-auto px-20 w-1/2">
        <div class="header flex flex-row items-center pb-7 mt-7">
            <div class="title">
                <h2 class="text-3xl font-bold">About Us</h2>
                <p class="text-sm">Apa sih !nfoeri (infoeri) itu ?</p>
            </div>
        </div>
        <p>
            Infoeri adalah salah satu media info event yang menyediakan berbagai macam event seperti webinar dan pelatihan. Anda tak perlu susah mencari event yang diinginkan, cukup infoeri saja, karena kami lebih terjangkau. Apapun dan dimanapun anda tinggal pilih dan klik di infoeri.
        </p>
        <form action="/" method="get">
            <button type="submit" class="infoeri-button mt-7 px-10">Cari Event</button>
        </form>
    </div>
</div>
<div id="footer" class="mt-7">
    @include('layouts.footer')
</div>
@endsection