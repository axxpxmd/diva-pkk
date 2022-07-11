@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="card">
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Tambah Anggota | 
            @if ($status == 1)
            <span class="badge bg-success">Hidup</span>     
            @else
            <span class="badge bg-danger">Meninggal</span>
            @endif
        </h5>
        <div class="card-body">
            <!-- Stepper -->
            <div id="stepperForm" class="bs-stepper mt-2">
                <div class="bs-stepper-header mb-4 rounded-3" role="tablist" style="background: #F2F2F2">
                    <div class="step" data-target="#test-form-1">
                        <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger1" aria-controls="test-form-1">
                            <span class="bs-stepper-circle bg-info">
                                <span class="bi bi-person"></span>
                            </span>
                            <span class="bs-stepper-label" id="data1">Data 1</span>
                        </button>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-form-2">
                        <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger2" aria-controls="test-form-2">
                            <span class="bs-stepper-circle bg-warning">
                                <span class="bi bi-person"></span>
                            </span>
                            <span class="bs-stepper-label">Data 2</span>
                        </button>
                    </div>
                    <div class="bs-stepper-line"></div>
                    <div class="step" data-target="#test-form-3">
                        <button type="button" class="step-trigger" role="tab" id="stepperFormTrigger3" aria-controls="test-form-3">
                            <span class="bs-stepper-circle bg-success">
                                <span class="bi bi-person"></span>
                            </span>
                            <span class="bs-stepper-label">Data 3</span>
                        </button>
                    </div>
                </div>
                <div class="bs-stepper-content">
                    <!-- Stepper Content -->
                    <form class="needs-validation fs-14" id="form" method="POST" enctype="multipart/form-data" novalidate>
                        {{ method_field('POST') }}
                        <div id="test-form-1" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepperFormTrigger1">
                            <p class="text-center fw-bold fs-16">Data 1 : Berisikan data diri anggota keluarga</p>
                            @include('pages.anggota_keluarga.data1')
                        </div>
                        <div id="test-form-2" role="tabpanel" class="bs-stepper-pane fade" aria-labelledby="stepperFormTrigger2">
                            <p class="text-center fw-bold fs-16">Data 2 : Berisikan data kesehatan anggota keluarga</p>
                            @include('pages.anggota_keluarga.data2')
                        </div>
                        <div id="test-form-3" role="tabpanel" class="bs-stepper-pane fade text-center" aria-labelledby="stepperFormTrigger3">
                            <button type="submit" class="btn btn-primary mt-5">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('script')
<script type="text/javascript">

$(document).ready(function() {
    $('.select2').select2();
});

document.addEventListener('DOMContentLoaded', function () {
    var stepperFormEl = document.querySelector('#stepperForm')
    stepperForm = new Stepper(stepperFormEl, {
        animation: true,
        linear: true
    })

    var btnNextList = [].slice.call(document.querySelectorAll('.btn-next-form'))
    var stepperPanList = [].slice.call(stepperFormEl.querySelectorAll('.bs-stepper-pane'))
    var form = stepperFormEl.querySelector('.bs-stepper-content form')

    // Data 1
    $('#form').on('submit', function (event) {
        var status_dlm_klrga = $('input[name="status_dlm_klrga[]"]:checked')
        if (status_dlm_klrga.length == 0) {
            $('input[name="status_dlm_klrga[]"]').prop('required', true);
        }else{
            $('input[name="status_dlm_klrga[]"]').prop('required', false);
        }
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }else{    
            pus = $('#pus').val();
            wus = $('#wus').val();
            nik = $('#nik').val();
            nama = $('#nama').val();
            no_kk = $('#no_kk').val();
            agama = $('#agama').val();
            rumah_id = $('#rumah_id').val();
            tgl_lahir = $('#tgl_lahir').val();
            pekerjaan = $('#pekerjaan').val();
            tmpt_lahir = $('#tmpt_lahir').val();
            pendidikan = $('#pendidikan').val();
            dasawisma_id = $('#dasawisma_id').val();
            status_kawin = $('#status_kawin').val();

            // Radio
            jabatan = $('input[name="jabatan"]:checked').val();
            kelamin = $('input[name="kelamin"]:checked').val();
            domisili = $('input[name="domisili"]:checked').val();
            akta_kelahiran = $('input[name="akta_kelahiran"]:checked').val();
            status_pendidkan = $('input[name="status_pendidkan"]:checked').val();
            terdaftar_dukcapil = $('input[name="terdaftar_dukcapil"]:checked').val();

            // Checkbox 
            var status_dlm_klrga = $('input[name="status_dlm_klrga[]"]:checked')
            if (status_dlm_klrga.length == 0) {
                $('input[name="status_dlm_klrga[]"]').prop('required', true);
            }else{
                $('input[name="status_dlm_klrga[]"]').prop('required', false);
            }
            var status_dlm_klrga = $('input[name="status_dlm_klrga[]"]:checked').map(function() {
                return $(this).val();   
            }).get();

            $.ajax({
                url: "{{ route('anggota-keluarga.checkValidationForm1') }}",
                type: "POST",
                data: {
                    dasawisma_id: dasawisma_id,
                    rumah_id: rumah_id,
                    terdaftar_dukcapil: terdaftar_dukcapil,
                    nik: nik,
                    domisili: domisili,
                    no_kk: no_kk,
                    nama: nama,
                    kelamin: kelamin,
                    tmpt_lahir: tmpt_lahir,
                    tgl_lahir: tgl_lahir,
                    akta_kelahiran: akta_kelahiran,
                    status_kawin: status_kawin,
                    status_dlm_klrga: status_dlm_klrga,
                    agama: agama,
                    status_pendidkan: status_pendidkan,
                    pendidikan: pendidikan,
                    pekerjaan: pekerjaan,
                    jabatan: jabatan,
                    pus: pus,
                    wus: wus
                },
                success:function(response){
                    stepperForm.next()  
                },
                error:function(response){
                    error = ''; respon = response.responseJSON;
                    $.each(respon.errors, function(index, value){
                        error += "<li>" + value +"</li>";
                    });
                    err(error);
                }
            });
            return false;
        }
    });
})
</script>
@endpush