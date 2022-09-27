<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title -->
    <link rel="icon" href="{{ asset('images/logo/tangsel.png') }}" type="image/x-icon">
    <title>{{ config('app.name') }} | Form Login</title>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/util.css') }}">
    <link rel="stylesheet" href="{{ asset('asset-auth/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <!-- Icon -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        #footer {
            bottom: 0;
            position: fixed;
        }
    </style>
</head>
<body>
    <section class="master-bg-payment" style="background-image: url('images/logo/BG.jpg')">
		<div class="container">
			<div class="justify-content-center text-center mt-5">
                <div class="img-dynamic">
                    <img src="{{ asset('images/logo/tangsel.png') }}" width="90" class="img-fluid m-r-50" alt="Logo Tangsel">
                    <img src="{{ asset('images/logo/LOGO-PKK.png') }}" width="90" class="img-fluid" alt="Logo PKK">
                    <div class="mt-4">
                        <h6 class="font-weight-bolder text-black">PEMBERDAYAAN DAN KESEJAHTERAAN</h6>
                        <h6 class="font-weight-bolder text-black">KELUARGA (PKK) KOTA TANGERANG SELATAN</h6>
                    </div>
                </div>
                <div class="card bdr-r-card mt-4" style="background: #4FB2A5; border: 5px solid white;">
                    <div class="card-body p-3">
                        <div class="card bdr-r-card" style="background: #9CD5CE">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-sm-6 mb-2">
                                        <div class="card bdr-r-card" style="background: #9CD5CE; border: 2px solid #779A99">
                                            <div class="card-body">
                                                <h5 class="font-weight-bolder fs-25 ">Login</h5>
                                                <form method="POST" action="{{ route('login') }}" class="signin-form text-black">
                                                    @csrf
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text px-3 rounded-left"><i class="fa fa-user"></i></span>
                                                        </div>
                                                        <input type="text"name="username" class="form-control fs-12 @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="Username" autocomplete="off" autofocus>
                                                        @error('username')
                                                            <div class="invalid-feedback mb-0 text-left" role="alert"><strong><span class="fs-12">{{ $message }}</span></strong></div>
                                                        @enderror
                                                    </div>

                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text px-3 rounded-left"><i class="fa fa-lock"></i></span>
                                                        </div>
                                                        <input type="password"name="password" class="form-control fs-12 @error('password') is-invalid @enderror" value="{{ old('password') }}" placeholder="password" autocomplete="off">
                                                        @error('password')
                                                            <div class="invalid-feedback mb-0 text-left" role="alert"><strong><span class="fs-12">{{ $message }}</span></strong></div>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group mb-2 text-left">
                                                        <div class="custom-control custom-checkbox small">
                                                            <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                                            <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success btn-block bdr-r-30 px-3"><i class="fa fa-sign-in m-r-8"></i>Masuk</button>
                                                    </div>
                                                    @error('user') 
                                                        <div class="alert alert-danger mt-2 fs-14 text-center">{{ $message }}</div>
                                                    @enderror
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 justify-content-center d-flex align-items-center">
                                        <div class="text-center">
                                            <h6 class="font-weight-bolder text-black">Digitalisasi Data Warga</h6>
                                            <h6 class="font-weight-bolder text-black">Pemberdayaan Kesejahteraan</h6>
                                            <h6 class="font-weight-bolder text-black">Keluarga</h6>
                                            <h5 class="font-weight-bolder">( DIVA PKK )</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="img-dynamic">
                    <img src="{{ asset('images/logo/iren.png') }}" width="80" class="img-fluid" alt="Logo Tangsel">
                    <div class="fixed-bottom mb-1">
                        <div class="p-2" style="background: rgba(255, 255, 255, 0.3); border-bottom: 5px #15927F solid; border-top: 3px #EFFCF5 solid">
                            <h6 class="font-weight-bolder text-black">CERDAS MODERN RELIGIUS</h6>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</section>
</body>
</html>