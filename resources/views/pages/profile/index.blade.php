@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
@include('layouts.alert')   
<section class="section animate__animated animate__fadeInRight">
    <div class="row">
        <div class="col-sm-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        @if ($user->foto == 'default.png')
                        <div class="avatar avatar-xl fs-40 bg-info">
                            <span class="avatar-content">{{ $acronym }}</span>
                        </div>
                        @else
                        <div class="avatar avatar-xl">
                            <img class="img-circular" src="{{ config('app.sftp_src').'foto_profile/'.$user->foto }}" alt="" srcset="">
                        </div>  
                        @endif
                        <div class="mt-3">
                            <h4>{{ $user->nama }}</h4>
                            <p>Anggota Dari Dasawisma <span class="fw-bold">{{ $user->dasawisma->nama }}</span></p>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <a href="#" class="btn btn-sm btn-warning fs-14" onclick="openModalResetPassword()"><i class="bi bi-key-fill m-r-8"></i>Password</a>
                            <a href="#" class="btn btn-sm btn-primary fs-14" onclick="openModalChangePhoto()"><i class="bi bi-camera-fill m-r-8"></i>Foto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="card">
                <h5 class="card-header px-4 py-3 bg-info text-white">Edit Profile</h5>
                <div class="card-body mt-4">
                    <form action="{{ route("profile.update", Auth::user()->id) }}" class="fs-14 needs-validation" novalidate method="post">
                        @csrf
                        <div>
                            <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" name="nama" id="nama" value="{{ $user->nama }}" class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <label for="nik" class="form-label fw-bold">NIK</label>
                            <input type="text" name="nik" id="nik" value="{{ $user->nik }}" class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <label for="no_telp" class="form-label fw-bold">No Telp</label>
                            <input type="text" name="no_telp" id="no_telp" value="{{ $user->no_telp }}" class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                            <textarea type="text" name="alamat" id="alamat" class="form-control" autocomplete="off" required>{{ $user->alamat }}</textarea>
                        </div>
                        <div class="mt-2">
                            <label for="username" class="form-label fw-bold">Username</label>
                            <input type="text" name="username" id="username" value="{{ $user->username }}" readonly class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <label for="" class="form-label fw-bold">Status Akun</label>
                            <input type="text" name="" id="" value="{{ $user->s_aktif == 1 ? 'Aktif' : 'Tidak Aktif' }}" readonly class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <label for="role_id" class="form-label fw-bold">Role Akun</label>
                            <input type="text" name="role_id" id="role_id" value="{{ $user->modelHasRole->role->name }}" readonly class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-arrow-clockwise m-r-8"></i>Perbarui Akun</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info bg-info">
                <h5 class="modal-title text-white" id="txtTitle"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="display: none" id="resetPassword">
                    <form action="{{ route('profile.updatePassword', Auth::user()->id) }}" class="fs-14 needs-validation" novalidate method="post">
                        @csrf
                        <div>
                            <label for="password" class="form-label fw-bold">Password</label>
                            <input type="password" name="password" id="password" class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <label for="confirm_password" class="form-label fw-bold">Konfirmasi Password</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-arrow-clockwise m-r-8"></i>Perbarui Password</button>
                        </div>
                    </form>
                </div>

                <div style="display: none" id="changePhoto">
                    <form action="{{ route('profile.updatePhoto', Auth::user()->id) }}" method="post" enctype="multipart/form-data" novalidate>
                        @csrf
                        <img class="rounded-circle img-circular mb-2 mx-auto d-block" @if ($user->foto != 'default.png') src="{{ config('app.sftp_src').'foto_profile/'.$user->foto }}" @endif id="preview" width="150" height="150"/>
                        <div class="mt-3">
                            <input type="file" name="foto" id="file" class="form-control input-file" onchange="tampilkanPreview(this,'preview')">
                            <i class="fs-12 text-danger">Bisa berupa foto, logo, atau symbol icon. Maksimal 1 Mb.</i>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-success btn-sm"><i class="bi bi-arrow-clockwise m-r-8"></i>Perbarui Foto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">


    function openModalResetPassword(){
        $('#modalForm').modal('show');
        $('#resetPassword').show();
        $('#changePhoto').hide();
        $('#txtTitle').html('Ubah Password');
    }

    function openModalChangePhoto(){
        $('#modalForm').modal('show');
        $('#changePhoto').show();
        $('#resetPassword').hide();
        $('#txtTitle').html('Ubah Foto');
    }

     // file name preview
     (function () {
        'use strict';
        $('.input-file').each(function () {
            var $input = $(this),
                $label = $input.next('.js-labelFile'),
                labelVal = $label.html();

            $input.on('change', function (element) {
                var fileName = '';
                if (element.target.value) fileName = element.target.value.split('\\').pop();
                fileName ? $label.addClass('has-file').find('.js-fileName').html(fileName) : $label
                    .removeClass('has-file').html(labelVal);
            });
        });
    })();

    // image preview
    function tampilkanPreview(gambar, idpreview) {
        var gb = gambar.files;
        for (var i = 0; i < gb.length; i++) {
            var gbPreview = gb[i];
            var imageType = /image.*/;
            var preview = document.getElementById(idpreview);
            var reader = new FileReader();
            if (gbPreview.type.match(imageType)) {
                preview.file = gbPreview;
                reader.onload = (function (element) {
                    return function (e) {
                        element.src = e.target.result;
                    };
                })(preview);
                reader.readAsDataURL(gbPreview);
            } else {
                Swal.fire(
                    'Tipe file tidak boleh',
                    'Harus format gambar',
                    'error'
                )
            }
        }
    }
</script>
@endpush