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
            <span class="badge bg-success fs-14">Hidup</span>     
            @else
            <span class="badge bg-danger fs-14">Meninggal</span>
            @endif
        </h5>
        <div class="card-body">
            <div id="alert"></div>
            <a href="{{ route('anggota-keluarga.index') }}" class="text-danger fw-bold fs-14"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
            @if ($status == 1)
                @include('pages.anggota_keluarga.hidup')
            @else
                @include('pages.anggota_keluarga.meninggal')
            @endif
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
    var formStepper = document.querySelectorAll('.form-stepper')

    // Form 1
    $('#btnForm1Next').click(function(event){
        var status_dlm_klrga = $('input[name="status_dlm_klrga[]"]:checked')
        if (status_dlm_klrga.length == 0) {
            $('input[name="status_dlm_klrga[]"]').prop('required', true);
        }else{
            $('input[name="status_dlm_klrga[]"]').prop('required', false);
        }
       
        if (!formStepper[0].checkValidity()) {
            Array.prototype.slice.call(formStepper)
            .forEach(function (form) {
                form.classList.add('was-validated')
                event.preventDefault()
                event.stopPropagation()
            })
        }else{
            // Input
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
                    $('.add-required-form2').prop('required', true)
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
    })

    // Form 2
    $('#btnForm2Next').click(function(){
        var bpjs = $('input[name="bpjs[]"]:checked')
        if (bpjs.length == 0) {
            $('input[name="bpjs[]"]').prop('required', true);
        }else{
            $('input[name="bpjs[]"]').prop('required', false);
        }

        if (formStepper[0].checkValidity()) {
            Array.prototype.slice.call(formStepper)
            .forEach(function (form) {
                form.classList.add('was-validated')
                event.preventDefault()
                event.stopPropagation()
            })
        }else{
            // Input
            jenis_kb = $('#jenis_kb').val();
            frekuensi_posyandu = $('#frekuensi_posyandu').val();
            frekuensi_posbindu = $('#frekuensi_posbindu').val();
            status_ibu = $('#status_ibu').val();
            jenis_kbthn_khusus = $('#jenis_kbthn_khusus').val();
            jenis_buta = $('#jenis_buta').val();

            // Radio
            kb = $('input[name="kb"]:checked').val();
            aktif_posyandu = $('input[name="aktif_posyandu"]:checked').val();
            aktif_posbindu = $('input[name="aktif_posbindu"]:checked').val();
            status_anak = $('input[name="status_anak"]:checked').val();
            stunting = $('input[name="stunting"]:checked').val();
            kbthn_khusus = $('input[name="kbthn_khusus"]:checked').val();
            buta = $('input[name="buta"]:checked').val();
            makanan_pokok = $('input[name="makanan_pokok"]:checked').val();
            kelamin = $('input[name="kelamin"]:checked').val();

            // Checkbox 
            var bpjs = $('input[name="bpjs[]"]:checked').map(function() {
                return $(this).val();   
            }).get();

            $.ajax({
                url: "{{ route('anggota-keluarga.checkValidationForm2') }}",
                type: "POST",
                data: {
                    bpjs: bpjs,
                    kb: kb,
                    jenis_kb: jenis_kb,
                    aktif_posyandu: aktif_posyandu,
                    frekuensi_posyandu: frekuensi_posyandu,
                    aktif_posbindu: aktif_posbindu,
                    frekuensi_posbindu: frekuensi_posbindu,
                    status_ibu: status_ibu,
                    status_anak: status_anak,
                    stunting: stunting,
                    kbthn_khusus: kbthn_khusus,
                    jenis_kbthn_khusus: jenis_kbthn_khusus,
                    buta: buta,
                    jenis_buta: jenis_buta,
                    makanan_pokok: makanan_pokok,
                    kelamin: kelamin

                },
                success:function(response){
                    $('.add-required-form3').prop('required', true)
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
    })

    // Form 3
    $('#form-hidup').on('submit', function (event) {
        var hatinya_pkk = $('input[name="hatinya_pkk[]"]:checked')
        if (hatinya_pkk.length == 0) {
            $('input[name="hatinya_pkk[]"]').prop('required', true);
        }else{
            $('input[name="hatinya_pkk[]"]').prop('required', false);
        }

        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }else{    
            $('#loading').show();
            $('#alert').html('');
           
            url = "{{ route('anggota-keluarga.storeHidup') }}";
            $.post(url, $(this).serialize(), function(data){
                $('#alert').html("<div class='alert alert-success alert-dismissible' role='alert'><strong>Sukses!</strong> " + data.message + "</div>");
            },'json').fail(function(data){
                err = ''; respon = data.responseJSON;
                $.each(respon.errors, function(index, value){
                    err += "<li>" + value +"</li>";
                });
                $('#alert').html("<div class='alert alert-danger alert-dismissible' role='alert'>" + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
            }).always(function(){
                $('#loading').hide();
            });
            return false;
        }
        $(this).addClass('was-validated');
    });
})

// Form Meninggal
$('#form-meninggal').on('submit', function (event) {
    console.log('jalan');
    if ($(this)[0].checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
    }else{    
        $('#loading').show();
        $('#alert').html('');
        
        url = "{{ route('anggota-keluarga.storeMeninggal') }}";
        $.post(url, $(this).serialize(), function(data){
            succesStore(data.message);
        },'json').fail(function(data){
            err = ''; respon = data.responseJSON;
            $.each(respon.errors, function(index, value){
                err += "<li>" + value +"</li>";
            });
            $('#alert').html("<div class='alert alert-danger alert-dismissible fs-14' role='alert'>" + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
        }).always(function(){
            $('#loading').hide();
        });
        return false;
    }
    $(this).addClass('was-validated');
});
</script>
@endpush