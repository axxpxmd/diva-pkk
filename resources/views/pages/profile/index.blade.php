@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
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
                            <img src="assets/images/faces/3.jpg" alt="" srcset="">
                        </div>  
                        @endif
                        <div class="mt-3">
                            <h4>{{ $user->nama }}</h4>
                            <p>Anggota Dari Dasawisma <span class="fw-bold">{{ $user->dasawisma->nama }}</span></p>
                        </div>
                        <hr>
                        <div class="mt-2">
                            <a href="#" class="btn btn-warning fs-14 mb-5-m" onclick="openModalResetPassword()"><i class="bi bi-key-fill m-r-8"></i>Ubah Password</a>
                            <a href="#" class="btn btn-primary fs-14" onclick="openModalChangePhoto()"><i class="bi bi-camera-fill m-r-8"></i>Ubah Foto</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-7">
            <div class="card">
                <h5 class="card-header px-4 py-3 bg-info text-white">Edit Profile</h5>
                <div class="card-body mt-4">
                    <form id="form" class="fs-14">
                        {{ method_field('POST') }}
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
                            <label for="rtrw_id" class="form-label fw-bold">Alamat</label>
                            <input type="text" name="rtrw_id" id="rtrw_id" value="{{ $user->rtrw->kecamatan->n_kecamatan }} - {{ $user->rtrw->kelurahan->n_kelurahan }} - RT {{ $user->rtrw->rw }} / RW {{ $user->rtrw->rt }}" readonly class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <label for="s_aktif" class="form-label fw-bold">Status Akun</label>
                            <input type="text" name="s_aktif" id="s_aktif" value="{{ $user->s_aktif == 1 ? 'Aktif' : 'Tidak Aktif' }}" readonly class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <label for="role_id" class="form-label fw-bold">Role Akun</label>
                            <input type="text" name="role_id" id="role_id" value="{{ $user->modelHasRole->role->name }}" readonly class="form-control" autocomplete="off" required/>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-success"><i class="bi bi-arrow-clockwise m-r-8"></i>Perbarui Akun</button>
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
                <h5 class="modal-title text-white"><span id="txtTitle"></span>Ubah Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div style="display: none" id="resetPassword">
                    ini buat ubah password
                </div>

                <div style="display: none" id="changePhoto">
                    ini buat ubah foto
                </div>
                {{-- <form id="form" class="fs-14">
                    {{ method_field('POST') }}
                </form> --}}
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
    }

    function openModalChangePhoto(){
        $('#modalForm').modal('show');
        $('#changePhoto').show();
        $('#resetPassword').hide();
    }
</script>
@endpush