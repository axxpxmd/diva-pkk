@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>Tambah {{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div id="alert"></div>
    <div class="card">  
        <h5 class="card-header bg-info text-white mb-2 p-3">Form Tambah Data</h5>
        <div class="card-body">
            <a href="{{ route('rumah.index') }}" class="fs-14 text-danger fw-bold"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
            <form class="needs-validation fs-14" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                {{ method_field('POST') }}
                <div class="row">
                    <div class="col-sm-6">
                        <div class="row mb-2">
                            <label for="dasawisma_id" class="col-sm-4 col-form-label fw-bold text-end">Dasawisma <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="select2 form-select" id="dasawisma_id" name="dasawisma_id" required>
                                    <option value="">Pilih</option>
                                    @foreach ($dasawismas as $i)
                                        <option value="{{ $i->id }}" {{ $i->id == $dasawisma_id ? 'selected' : '-' }}>{{ $i->nama }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan pilih dasawisma.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="rtrw_id" class="col-sm-4 col-form-label fw-bold text-end">RT/RW <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <select class="select2 form-select" id="rtrw_id" name="rtrw_id" required>
                                    <option value="">Pilih</option>
                                    @foreach ($rtrws as $i)
                                        <option value="{{ $i->id }}" {{ $i->id == $rtrw_id ? 'selected' : '-' }}>
                                            {{ $i->kecamatan->n_kecamatan }} - {{ $i->kelurahan->n_kelurahan }} - RT {{ $i->rw }} / RW {{ $i->rt }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Silahkan pilih RT/RW.
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="alamat_detail" class="col-sm-4 col-form-label text-end fw-bold">Alamat <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <textarea type="text" name="alamat_detail" id="alamat_detail" placeholder="Bisa diisi Nomor Rumah / Blok / Cluster" class="form-control" autocomplete="off" required></textarea>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="kepala_rumah" class="col-sm-4 col-form-label text-end fw-bold">Kepala Rumah <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="kepala_rumah" id="kepala_rumah" class="form-control" placeholder="Nama Kepala Rumah" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="jamban" class="col-sm-4 col-form-label text-end fw-bold">Jumlah Jamban <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="number" name="jamban" id="jamban" class="form-control" placeholder="Jumlah jamban keluarga" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="mkn_pokok" class="col-sm-4 col-form-label text-end fw-bold">Sumber Air <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="checkbox" name="sumber_air[]" id="pdam" value="PDAM" class="form-check-input">
                                <label class="form-check-label m-l-10" for="pdam">
                                    PDAM
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="checkbox" name="sumber_air[]" id="sumur" value="Sumur" class="form-check-input">
                                <label class="form-check-label m-l-10" for="sumur">
                                    Sumur
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="mkn_pokok" class="col-sm-4 col-form-label text-end fw-bold"></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="checkbox" name="sumber_air[]" id="sungai" value="Sungai" class="form-check-input">
                                <label class="form-check-label m-l-10" for="sungai">
                                    Sungai
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="checkbox" name="sumber_air[]" id="lainnya" class="form-check-input">
                                <label class="form-check-label m-l-10" for="lainnya">
                                    Lainnya
                                </label>
                                <input type="text" id="lainnya_value" onkeyup="valueToLainnya()" class="form-control mt-2" style="display: none" placeholder="Tambahkan Lainnya" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row mb-2">
                            <label for="tempat_smph" class="col-sm-4 col-form-label text-end fw-bold">Pembuangan Sampah <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="0" name="tempat_smph" id="tempat_smph" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="tempat_smph">
                                    Tidak
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="tempat_smph" id="tempat_smph" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="tempat_smph">
                                    Ya
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="saluran_pmbngn" class="col-sm-4 col-form-label text-end fw-bold">Pembuangan Limbah <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="0" name="saluran_pmbngn" id="saluran_pmbngn" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="saluran_pmbngn">
                                    Tidak
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="saluran_pmbngn" id="saluran_pmbngn" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="saluran_pmbngn">
                                    Ya
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="stiker_p4k" class="col-sm-4 col-form-label text-end fw-bold">Stiker P4K <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="0" name="stiker_p4k" id="stiker_p4k" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="stiker_p4k">
                                    Tidak
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="stiker_p4k" id="stiker_p4k" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="stiker_p4k">
                                    Ya
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="kriteria_rmh" class="col-sm-4 col-form-label text-end fw-bold">Kriteria Rumah <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="0" name="kriteria_rmh" id="kriteria_rmh" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="kriteria_rmh">
                                    Kurang Sehat
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="kriteria_rmh" id="kriteria_rmh" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="kriteria_rmh">
                                    Sehat
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="layak_huni" class="col-sm-4 col-form-label text-end fw-bold">Layak Huni <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="0" name="layak_huni" id="layak_huni" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="layak_huni">
                                    Tidak
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="layak_huni" id="layak_huni" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="layak_huni">
                                    Ya
                                </label>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-sm-4"></div>
                            <div class="col-sm-8">
                                <button type="submit" class="btn btn-success fs-14" title="Simpan Data" id="btnSave"><i class="bi bi-save m-r-8"></i>Simpan Data</button>
                                <a href="#" onclick="reset()" class="m-l-5 text-danger fw-bold  fs-14" title="Kosongkan Form"><i class="bi bi-arrow-clockwise m-r-8"></i>Reset</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });

    function valueToLainnya(){
        val = $('#lainnya_value').val();
        $('#lainnya').val(val);
    }

    $('#lainnya').click(function() {
        if ($('#lainnya').is(":checked")){
            $('#lainnya_value').show();
            $("#lainnya_value").prop('required',true);
            $('#lainnya_value').focus();
        }else{
            $('#lainnya_value').hide();
            $("#lainnya_value").prop('required',false);
            $('#lainnya').val(null);
        }
    });

    function reset(){
        $('#form').trigger('reset');
        $('#lainnya_value').hide();
        $("#lainnya_value").prop('required',false);
        $('#lainnya').val(null);
    };

    $('#form').on('submit', function (event) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }else{    
            $('#loading').show();
            $('#alert').html('');
            $('#btnSave').attr('disabled', true);
            
            url = "{{ route('rumah.store') }}"
            $.post(url, $(this).serialize(), function(data){
                $('#alert').html("<div class='alert alert-success alert-dismissible fs-14' role='alert'><strong>Sukses!</strong> " + data.message + "</div>");
                reset();
            },'json').fail(function(data){
                err = ''; respon = data.responseJSON;
                $.each(respon.errors, function(index, value){
                    err += "<li>" + value +"</li>";
                });
                $('#alert').html("<div class='alert alert-danger alert-dismissible fs-14' role='alert'>" + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
            }).always(function(){
                $('#loading').hide();
                $('#btnSave').removeAttr('disabled');
            });
            return false;
        }
        $(this).addClass('was-validated');
    });
</script>
@endpush