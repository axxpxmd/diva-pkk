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
                            <div class="row mb-2">
                                <label for="test" class="col-sm-2 col-form-label text-end fw-bold">Alamat <span class="text-danger">*</span></label>
                                <div class="col-sm-10">
                                    <textarea type="text" name="test" id="test" placeholder="Bisa diisi Nomor Rumah / Blok / Cluster" class="form-control" autocomplete="off"></textarea>
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary" onclick="stepperForm.previous()">Previous</button>
                            <button type="button" class="btn btn-primary" onclick="stepperForm.next()">Next</button>
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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
    var formInput = document.querySelectorAll('#form')

    $('#btnForm1').on('click', function(event) {
        if (formInput[0].checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }

        dasawisma_id = $('#dasawisma_id').val();
        rumah_id = $('#rumah_id').val();
        terdaftar_dukcapil = $('input[name="terdaftar_dukcapil"]:checked').val();
        nik = $('#nik').val();

        $.ajax({
            url: "{{ route('anggota-keluarga.checkValidationForm1') }}",
            type: "POST",
            data: {
                dasawisma_id: dasawisma_id,
                rumah_id: rumah_id,
                terdaftar_dukcapil: terdaftar_dukcapil,
                nik: nik
            },
            cache: false,
            success:function(response){
                stepperForm.next()  
            },
            error:function(){
                // err();
            }
        });
    });
})
</script>
@endpush