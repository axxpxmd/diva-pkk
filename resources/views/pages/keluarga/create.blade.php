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
            <a href="{{ route('keluarga.index') }}" class="fs-14 text-danger fw-bold"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
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
                                        <option value="{{ $i->id }}">{{ $i->nama }}</option>
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
                                        <option value="{{ $i->id }}">
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
                                <span class="text-warning fs-13">Gunakan alamat yg sama jika lebih dari 1 kepala keluarga</span>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="nm_kpl_klrg" class="col-sm-4 col-form-label text-end fw-bold">Nama Kepala <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="nm_kpl_klrg" id="nm_kpl_klrg" class="form-control" placeholder="Nama Kepala Keluarga" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="jumlah" class="col-sm-4 col-form-label text-end fw-bold">Jumlah Anggota <span class="text-danger">*</span></label>
                            <div class="col-sm-4 mb-5-m">
                                <input type="number" name="jml_laki" id="jml_laki" class="form-control" placeholder="Laki - Laki" autocomplete="off" required>
                            </div>
                            <div class="col-sm-4">
                                <input type="number" name="jml_perempuan" id="jml_perempuan" class="form-control" placeholder="Perempuan" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="jumlah" class="col-sm-4 col-form-label text-end fw-bold">Jumlah </label>
                            <div class="col-sm-4 mb-5-m">
                                <input type="number" name="balita" id="balita" class="form-control" placeholder="Balita" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <input type="number" name="pus" id="pus" class="form-control" placeholder="PUS" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="jumlah" class="col-sm-4 col-form-label text-end fw-bold"></label>
                            <div class="col-sm-4 mb-5-m">
                                <input type="number" name="wus" id="wus" class="form-control" placeholder="WUS" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <input type="number" name="buta" id="buta" class="form-control" placeholder="Buta" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="jumlah" class="col-sm-4 col-form-label text-end fw-bold"></label>
                            <div class="col-sm-4 mb-5-m">
                                <input type="number" name="ibu_hamil" id="ibu_hamil" class="form-control" placeholder="Ibu Hamil" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <input type="number" name="ibu_menyusui" id="ibu_menyusui" class="form-control" placeholder="Ibu Menyusui" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="jumlah" class="col-sm-4 col-form-label text-end fw-bold"></label>
                            <div class="col-sm-4 mb-5-m">
                                <input type="number" name="lansia" id="lansia" class="form-control" placeholder="Lansia" autocomplete="off">
                            </div>
                            <div class="col-sm-4">
                                <input type="number" name="berkebutuhan_khusus" id="berkebutuhan_khusus" class="form-control" placeholder="Berkebutuhan Khusus" autocomplete="off">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="mkn_pokok" class="col-sm-4 col-form-label text-end fw-bold">Makanan Pokok <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="checkbox" name="beras" id="beras" class="form-check-input">
                                <label class="form-check-label m-l-10" for="beras">
                                    Beras
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="checkbox" name="non_beras" id="non_beras" class="form-check-input">
                                <label class="form-check-label m-l-10" for="non_beras">
                                    Non Beras
                                </label>
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
                                <input type="checkbox" name="pdam" id="pdam" class="form-check-input">
                                <label class="form-check-label m-l-10" for="pdam">
                                    PDAM
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="checkbox" name="sumur" id="sumur" class="form-check-input">
                                <label class="form-check-label m-l-10" for="sumur">
                                    Sumur
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="mkn_pokok" class="col-sm-4 col-form-label text-end fw-bold"></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="checkbox" name="sungai" id="sungai" class="form-check-input">
                                <label class="form-check-label m-l-10" for="sungai">
                                    Sungai
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="checkbox" name="lainnya" id="lainnya" value="1" class="form-check-input">
                                <label class="form-check-label m-l-10" for="lainnya">
                                    Lainnya
                                </label>
                                <input type="text" name="lainnya_value" id="lainnya_value" class="form-control mt-2" style="display: none" placeholder="Tambahkan Lainnya" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row mb-2">
                            <label for="tempat_smph" class="col-sm-4 col-form-label text-end fw-bold">Pembuangan Sampah <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="tempat_smph" id="tempat_smph" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="beras">
                                    Tidak
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="2" name="tempat_smph" id="tempat_smph" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="non_beras">
                                    Ya
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="saluran_pmbngn" class="col-sm-4 col-form-label text-end fw-bold">Pembuangan Limbah <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="saluran_pmbngn" id="saluran_pmbngn" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="beras">
                                    Tidak
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="2" name="saluran_pmbngn" id="saluran_pmbngn" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="non_beras">
                                    Ya
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="stiker_p4k" class="col-sm-4 col-form-label text-end fw-bold">Stiker P4K <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="stiker_p4k" id="stiker_p4k" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="beras">
                                    Tidak
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="2" name="stiker_p4k" id="stiker_p4k" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="non_beras">
                                    Ya
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="kriteria_rmh" class="col-sm-4 col-form-label text-end fw-bold">Kriteria Rumah <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="kriteria_rmh" id="kriteria_rmh" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="beras">
                                    Kurang Sehat
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="2" name="kriteria_rmh" id="kriteria_rmh" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="non_beras">
                                    Sehat
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="aktifitas_up2k" class="col-sm-4 col-form-label text-end fw-bold">Aktifitas UP2K <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="aktifitas_up2k" id="aktifitas_up2k" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="beras">
                                    Tidak
                                </label>
                                <input type="text" name="aktifitas_up2k_usaha" id="aktifitas_up2k_usaha_display" class="form-control mt-2" style="display: none" placeholder="Jenis Usaha" autocomplete="off">
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="2" name="aktifitas_up2k" id="aktifitas_up2k" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="non_beras">
                                    Ya
                                </label>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <label for="aktifitas_lngkngn" class="col-sm-4 col-form-label text-end fw-bold">Aktif di Lingkungan <span class="text-danger">*</span></label>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="1" name="aktifitas_lngkngn" id="aktifitas_lngkngn" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="beras">
                                    Tidak
                                </label>
                            </div>
                            <div class="col-sm-4 m-t-6">
                                <input type="radio" value="2" name="aktifitas_lngkngn" id="aktifitas_lngkngn" class="form-check-input" required>
                                <label class="form-check-label m-l-10" for="non_beras">
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

    $("input[name='aktifitas_up2k']").change(function(){
        val = $(this).val();
        if (val == 1) {
            $('#aktifitas_up2k_usaha_display').show();
            $("#aktifitas_up2k_usaha_display").prop('required',true);
            $('#aktifitas_up2k_usaha_display').focus();
        } else {
            $('#aktifitas_up2k_usaha_display').hide();
            $("#aktifitas_up2k_usaha_display").prop('required',false);
            $('#aktifitas_up2k_usaha_display').val(null);
        }
    });

    $('#lainnya').click(function() {
        if ($('#lainnya').is(":checked")){
            $('#lainnya_value').show();
            $("#lainnya_value").prop('required',true);
            $('#lainnya_value').focus();
        }else{
            $('#lainnya_value').hide();
            $("#lainnya_value").prop('required',false);
            $('#lainnya_value').val(null);
        }
    });

    function reset(){
        $('#form').trigger('reset');
    };

    $('#form').on('submit', function (event) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }else{    
            $('#loading').show();
            $('#alert').html('');
            $('#btnSave').attr('disabled', true);
            
            url = "{{ route('keluarga.store') }}"
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