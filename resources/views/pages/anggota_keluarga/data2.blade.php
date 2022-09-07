<div class="row mt-2">
    <div class="col-sm-6">
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Peserta BPJS <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="0" name="bpjs" id="bpjs" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="1" name="bpjs" id="bpjs" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="checkbox" value="1" name="bpjs_lainnya" id="bpjs_lainnya" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Lainnya
                </label>
            </div>
        </div>
        <div class="row mb-2" style="display: none" id="asuransi_lainnya_display">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <select class="select2 form-select" id="asuransi_lainnya" name="asuransi_lainnya[]">
                </select>
                <div class="invalid-feedback">
                    Masukan asuransi lainnya.
                </div>
            </div>
        </div>
        <div class="row mb-2" id="kb_display" style="display: none">
            <label class="col-sm-4 col-form-label text-end fw-bold">Akseptor KB <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Tidak" name="kb" id="kb" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Ya" name="kb" id="kb" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
            <div class="col-sm-4 m-t-6" id="jenis_kb_display" style="display: none">
                <select class="select2 form-select" id="jenis_kb" name="jenis_kb">
                    <option value="">Pilih</option>
                    <option value="PIL">PIL</option>
                    <option value="Suntik">Suntik</option>
                    <option value="Implant">Implant</option>
                    <option value="IUD">IUD</option>
                    <option value="MOP/MOW">MOP/MOW</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih jenis KB.
                </div>
            </div>
        </div>
        <div class="row mb-2" id="posyandu_display" style="display: none">
            <label class="col-sm-4 col-form-label text-end fw-bold">Aktif Posyandu <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Tidak" name="aktif_posyandu" id="aktif_posyandu" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Ya" name="aktif_posyandu" id="aktif_posyandu" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
            <div class="col-sm-4 m-t-6" id="frekuensi_posyandu_display" style="display: none">
                <input type="number" name="frekuensi_posyandu" id="frekuensi_posyandu" class="form-control" placeholder="Frekuensi / Kali" autocomplete="off">
            </div>
        </div>
        <div class="row" id="posbindu_display" style="display: none">
            <label class="col-sm-4 col-form-label text-end fw-bold">Aktif Posbindu <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Tidak" name="aktif_posbindu" id="aktif_posbindu" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Ya" name="aktif_posbindu" id="aktif_posbindu" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
            <div class="col-sm-4 m-t-6" id="frekuensi_posbindu_display" style="display: none">
                <input type="number" name="frekuensi_posbindu" id="frekuensi_posbindu" class="form-control" placeholder="Frekuensi / Kali" autocomplete="off">
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label fw-bold text-end">Status Ibu</label>
            <div class="col-sm-8">
                <select class="select2 form-select" id="status_ibu" name="status_ibu">
                    <option value="">Pilih</option>
                    <option value="Ibu Hamil">Ibu Hamil</option>
                    <option value="Melahirkan">Melahirkan</option>
                    <option value="Nifas">Nifas</option>
                    <option value="Menyusui">Menyusui</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih status Ibu.
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Status Anak</label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Bayi" name="status_anak" id="status_anak" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Bayi (0-1 Tahun)
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Balita" name="status_anak" id="status_anak" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Balita (1-5 Tahun)
                </label>
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Stunting</label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="stunting" id="stunting" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="stunting" id="stunting" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Kebutuhan Khusus <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Tidak" name="kbthn_khusus" id="kbthn_khusus" class="form-check-input add-required-form2">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Ya" name="kbthn_khusus" id="kbthn_khusus" class="form-check-input add-required-form2">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
            <div class="col-sm-4 m-t-6" id="jenis_kbthn_khusus_display" style="display: none">
                <select class="select2 form-select add-required-form2" id="jenis_kbthn_khusus" name="jenis_kbthn_khusus">
                    <option value="">Pilih</option>
                    <option value="Fisik">Fisik</option>
                    <option value="Non-Fisik">Non-Fisik</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih jenis Kebutuhan Khusus.
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Penyandang 3 Buta <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="0" name="buta" id="buta" class="form-check-input add-required-form2">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="1" name="buta" id="buta" class="form-check-input add-required-form2">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
            <div class="col-sm-4 m-t-6" id="jenis_buta_display" style="display: none">
                <select class="select2 form-select add-required-form2" id="jenis_buta" name="jenis_buta[]" multiple="multiple">
                    <option value="">Pilih</option>
                    <option value="Baca">Buta Baca</option>
                    <option value="Tulis">Tulis</option>
                    <option value="Hitung">Hitung</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih jenis Kebutuhan Khusus.
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Makanan Pokok <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="makanan_pokok" id="makanan_pokok" class="form-check-input add-required-form2">
                <label class="form-check-label m-l-10">
                    Non-Beras
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="makanan_pokok" id="makanan_pokok" class="form-check-input add-required-form2">
                <label class="form-check-label m-l-10">
                    Beras
                </label>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <button type="button" class="btn btn-block btn-warning fs-14 m-r-5" id="btnForm2Previous" onclick="stepperForm.previous()"><i class="bi bi-arrow-left m-r-8"></i>Kembali</button>
                    </div>
                    <div class="col-sm-6">
                        {{-- <button type="button" class="btn btn-block btn-info fs-14" id="btnForm2Next"><i class="bi bi-arrow-right m-r-8"></i>Selanjutnya</button> --}}
                        <button type="submit" class="btn btn-block btn-info fs-14"><i class="bi bi-save m-r-8"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    $('#btnForm2Previous').click(function() {
        $('.add-required-form2').prop('required', false)
    })

    $("input[name='bpjs_lainnya']").on('change', function(){
       
        if ($('#bpjs_lainnya').is(":checked")) {
            $('#asuransi_lainnya_display').show();
            $('#asuransi_lainnya').prop("required", false);
        } else {
            $('#asuransi_lainnya_display').hide();
            $('#asuransi_lainnya').val("").trigger("change.select2");
            $('#asuransi_lainnya').prop("required", true);
        }

        $('#asuransi_lainnya').select2({
            multiple: true,
            tags:true,
            placeholder: 'Masukan asuransi lainnya'
        });
    });

    // Penyandang 3 Buta
    $("input[name='buta']").on('change', function(){
        val = $(this).val();
        if (val == 1) {
            $('#jenis_buta_display').show();
            $("#jenis_buta").prop('required',true);
            $("#jenis_buta").select2({
                placeholder: "Pilih Jenis Penyandang Buta",
                allowClear: true
            });
        } else {
            $('#jenis_buta_display').hide();
            $("#jenis_buta").prop('required',false);
            $('#jenis_buta').val(0).trigger("change.select2");
        }
    });

    // Kebutuhan Khusus
    $("input[name='kbthn_khusus']").on('change', function(){
        val = $(this).val();
        if (val === 'Ya') {
            $('#jenis_kbthn_khusus_display').show();
            $("#jenis_kbthn_khusus").prop('required',true);
        } else {
            $('#jenis_kbthn_khusus_display').hide();
            $("#jenis_kbthn_khusus").prop('required',false);
            $('#jenis_kbthn_khusus').val(null).trigger("change.select2");
        }
    });

    // KB
    $("input[name='kb']").on('change', function(){
        val = $(this).val();
        if (val === 'Ya') {
            $('#jenis_kb_display').show();
            $("#jenis_kb").prop('required',true);
            $('#posyandu_display').show();
            $('#posbindu_display').show();
        } else {
            $('#jenis_kb_display').hide();
            $('#jenis_kb').val(null).trigger("change.select2");
            $("#jenis_kb").prop('required',false);
            $('#posyandu_display').hide();
            $('#posbindu_display').hide();
        }
    });

    // Posbindu
    $("input[name='aktif_posbindu']").on('change', function(){
        val = $(this).val();
        if (val === 'Ya') {
            $('#frekuensi_posbindu_display').show();
            $("#frekuensi_posbindu").prop('required',true);
            $('#frekuensi_posbindu').focus();
        } else {
            $('#frekuensi_posbindu_display').hide();
            $("#frekuensi_posbindu").prop('required',false);
            $('#frekuensi_posbindu').val(null);
        }
    });

    // Posyandu
    $("input[name='aktif_posyandu']").on('change', function(){
        val = $(this).val();
        if (val === 'Ya') {
            $('#frekuensi_posyandu_display').show();
            $("#frekuensi_posyandu").prop('required',true);
            $('#frekuensi_posyandu').focus();
        } else {
            $('#frekuensi_posyandu_display').hide();
            $("#frekuensi_posyandu").prop('required',false);
            $('#frekuensi_posyandu').val(null);
        }
    });
</script>
@endpush