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
</head>
<body>
    <section class="master-bg-payment" style="background-image: url('images/logo/BG.jpg')">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex mt-5">
						<div class="login-wrap px-5 py-4">
							<div class="text-center">
                                <img src="{{ asset('images/logo/tangsel.png') }}" width="120" alt="">
								<div class="text-center p-2">
                                    <h5 class="m-0 text-grey">Selamat Datang Di
                                        <br>
                                        <b>SIPESAT</b>
                                    </h5>
                                    <span class="fs-13">Sistem Pengajuan Surat RT/RW</span>
								</div>
							</div>
							<form method="POST" action="{{ route('login', 'type=2') }}" class="signin-form mb-5">
                                @csrf
								<div class="form-group mb-3">
									<input type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="NIK" autocomplete="off" autofocus>
                                    @error('username')
                                        <div class="invalid-feedback" role="alert"><strong><span class="fs-12">NIK tidak ditemukan.</span></strong></div>
                                    @enderror
								</div>
								<div class="form-group mb-2">
									<input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" autocomplete="off">
                                    @error('password')
                                    <div class="invalid-feedback" role="alert"><strong><span class="fs-12">{{ $message }}</span></strong></div>
                                    @enderror
								</div>
                                <div class="form-group mb-2">
									<div class="custom-control custom-checkbox small">
                                        <input type="checkbox" name="remember" class="custom-control-input" id="customCheck">
                                        <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                    </div>
								</div>
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block bdr-r-30 px-3">Masuk</button>
								</div>
                                @error('user') 
                                    <div class="alert alert-danger mt-2 mb-0 fs-14 text-center">NIK atau password tidak ditemukan.</div>
                                @enderror
							</form>
						</div>
                        <div class="img img-dynamic" style="background-image: url({{ asset('images/logo/login.jpg') }});">
                        </div>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>