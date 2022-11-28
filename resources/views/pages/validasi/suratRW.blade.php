<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title --> 
    <link rel="icon" href="{{ asset('images/logo/tangsel.png') }}" type="image/x-icon">
    <title>{{ env('APP_NAME') }} | Validasi Surat</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/shared/iconly.css') }}">
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">

    <!-- Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.1.1/css/fontawesome.min.css" integrity="sha384-zIaWifL2YFF1qaDiAo0JFgsmasocJ/rqu7LKYH8CoBEXqGbb9eO+Xi3s6fQhgFWM" crossorigin="anonymous">
    
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
   
</head>
<body>
    <div class="col-md-4 container justify-content-center">
        <div class="mt-5">
            <div class="card shadow">
                <div class="card-body text-center">
                    <p class="fw-bold text-black fs-20 mb-4">SURAT TERVERIFIKASI</p>
                    <img src="{{ asset('images/verification.png') }}" width="200" alt="surat terverifikasi">
                    <p class="fw-bold fs-14 text-black mt-5 mb-1">Surat sudah disetujui oleh RW</p>
                    <p class="fw-bold fs-14 text-black">No Surat : {{ $data->no_surat }}</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
