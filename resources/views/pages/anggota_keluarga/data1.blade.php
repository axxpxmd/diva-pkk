<div class="row mt-2">
    <div class="col-sm-6">
        <div class="bg-light-secondary p-2 rounded mb-3">
            <span class="fw-bold">Dasawisma</span>
        </div>
        @include('layouts.alamat2')
        <div class="row mb-2">
            <label for="dasawisma_id" class="col-sm-4 col-form-label fw-bold text-end">Dasawisma <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <select class="form-control select2" name="dasawisma_id" id="dasawisma_id" {{ $dasawisma_id ? 'disabled' : '' }}>
                    <option value="">Pilih</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih dasawisma.
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label fw-bold text-end">Rumah <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <select class="form-control select2" name="rumah_id" id="rumah_id" {{ $rumah_id ? 'disabled' : '' }}>
                    <option value="">Pilih</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih Rumah.
                </div>
            </div>
        </div>
        <hr>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Terdaftar Dukcapil <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="terdaftar_dukcapil" id="terdaftar_dukcapil" class="form-check-input" required>
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="terdaftar_dukcapil" id="terdaftar_dukcapil" {{ $no_kk ? 'checked' : '' }} class="form-check-input" required>
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">NIK</label>
            <div class="col-sm-8">
                <input type="text" maxlength="16" name="nik" id="nik" class="form-control" placeholder="16 Digit" autocomplete="off">
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Domisili</label>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6 m-t-6">
                        <input type="radio" value="0" name="domisili" id="domisili" class="form-check-input">
                        <label class="form-check-label m-l-10">
                            Luar Tangsel
                        </label>
                    </div>
                    <div class="col-sm-6 m-t-6">
                        <input type="radio" value="1" name="domisili" id="domisili" class="form-check-input">
                        <label class="form-check-label m-l-10">
                            Tangsel
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div id="alamatLuarTangsel">
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label text-end fw-bold"></label>
                <div class="col-sm-8">
                    <textarea type="text" name="almt_luar_tangsel" id="almt_luar_tangsel" placeholder="Alamat Luar Tangsel" class="form-control" autocomplete="off"></textarea>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">No KK</label>
            <div class="col-sm-8">
                @if ($no_kk)
                <input type="number" name="no_kk" id="no_kk" class="form-control" value="{{ $no_kk }}" autocomplete="off">
                @else
                <select class="form-control select2" name="no_kk" id="no_kk">
                    <option value="">Pilih</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih No KK.
                </div>
                @endif
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" autocomplete="off" required>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Laki - laki" name="kelamin" id="kelamin" class="form-check-input" required>
                <label class="form-check-label m-l-10">
                    Laki - laki
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Perempuan" name="kelamin" id="kelamin" class="form-check-input" required>
                <label class="form-check-label m-l-10">
                    Perempuan
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <textarea type="text" name="tmpt_lahir" id="tmpt_lahir" placeholder="Tempat Lahir" class="form-control" autocomplete="off" required></textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-5">
                        <input type="date" name="tgl_lahir" id="tgl_lahir" class="form-control" placeholder="Tanggal Lahir" autocomplete="off" required>
                    </div>
                    <label class="col-sm-3 col-form-label" style="margin-bottom: -10px">Usia : <span id="age">. . .</span></label>
                    <div class="col-sm-4">
                        <label class="col-form-label"><span class="badge bg-success fs-11" id="wusDisplay" style="display: none">Wanita Usia Subur</span></label>
                        <input type="hidden" name="wus" id="wus">
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Akte Kelahiran <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Tidak" name="akta_kelahiran" id="akta_kelahiran" class="form-check-input" required>
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Ya" name="akta_kelahiran" id="akta_kelahiran" class="form-check-input" required>
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
            <div class="col-sm-3 m-t-6">
                <input type="radio" value="Proses" name="akta_kelahiran" id="akta_kelahiran" class="form-check-input" required>
                <label class="form-check-label m-l-10">
                    Proses
                </label>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label fw-bold text-end">Status Perkawinan <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <select class="select2 form-select" id="status_kawin" name="status_kawin" required>
                    <option value="">Pilih</option>
                    <option value="Menikah">Menikah</option>
                    <option value="Lajang">Lajang</option>
                    <option value="Janda">Janda</option>
                    <option value="Duda">Duda</option>
                    <option value="Cerai Mati">Cerai Mati</option>
                    <option value="Cerai Hidup">Cerai Hidup</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih status perkawinan.
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <label class="col-form-label tex-center"><span class="badge bg-success fs-11" id="pusDisplay" style="display: none">Pasangan Usia Subur</span></label>
                <input type="hidden" name="pus" id="pus">
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label fw-bold text-end">Status Keluarga <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <select class="select2 form-select" id="status_dlm_klrga" name="status_dlm_klrga" required>
                    <option value="">Pilih</option>
                    <option value="Kepala Keluarga">Kepala Keluarga</option>
                    <option value="Suami">Suami</option>
                    <option value="Istri">Istri</option>
                    <option value="Anak">Anak</option>
                    <option value="Lansia">Lansia</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih status Keluarga.
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label fw-bold text-end">Agama <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <select class="select2 form-select" id="agama" name="agama" required>
                    <option value="">Pilih</option>
                    <option value="Islam">Islam</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Khatolik">Khatolik</option>
                    <option value="Hindu">Hindu</option>
                    <option value="Buddha">Buddha</option>
                    <option value="Khonghuchu">Khonghuchu</option>
                    <option value="Kepercayaan Lain">Kepercayaan Lain</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih agama.
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Pendidikan <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="status_pendidkan" id="status_pendidkan" class="form-check-input" required>
                <label class="form-check-label m-l-10">
                    Putus Sekolah
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="status_pendidkan" id="status_pendidkan" class="form-check-input" required>
                <label class="form-check-label m-l-10">
                    Tamat Sekolah
                </label>
            </div>
        </div>
        <div class="row mb-2" style="display: none" id="pendidikanDisplay">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <select class="select2 form-select" id="pendidikan" name="pendidikan" required>
                    <option value="">Pilih</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih jenjang pendidikan.
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label fw-bold text-end">Pekerjaan <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <select class="select2 form-select" id="pekerjaan" name="pekerjaan" required>
                    <option value="">Pilih</option>
                    <option value="ASN">ASN</option>
                    <option value="TNI / Polri">TNI / Polri</option>
                    <option value="Swasta">Swasta</option>
                    <option value="Wirausaha">Wirausaha</option>
                    <option value="Pelajar / Mahasiswa">Pelajar / Mahasiswa</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih pekerjaan.
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Jabatan </label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Managerial" name="jabatan" id="jabatan" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Managerial
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Staff" name="jabatan" id="jabatan" class="form-check-input">
                <label class="form-check-label m-l-10">
                    Staff
                </label>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <button type="button" class="btn btn-block btn-info fs-14" id="btnForm1Next"><i class="bi bi-arrow-right m-r-8"></i>Selanjutnya</button>
            </div>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    dasawisma_id = "{{ $dasawisma_id }}"
    rumah_id = "{{ $rumah_id }}"

    $('#rtrw_id').on('change', function(){
        $('#dasawisma_id').val("").trigger("change.select2");
        val = $(this).val();
        optionDasawisma = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#dasawisma_id').html(optionDasawisma);
        }else{
            $('#dasawisma_id').html("<option value=''>Loading...</option>");
            url = "{{ route('dasawismaByRTRW', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionDasawisma += "<option value='" + value.id + "'>" + value.nama +"</li>";
                    });
                    $('#dasawisma_id').empty().html(optionDasawisma);

                    if (dasawisma_id) {
                        $("#dasawisma_id").val(dasawisma_id); 
                        $("#dasawisma_id").trigger('change'); 
                    } else {
                        $("#dasawisma_id").val($("#dasawisma_id option:first").val());
                    }
                }else{
                    $('#dasawisma_id').html(optionDasawisma);
                }
            }, 'JSON'); 
        }
    });

    $('#dasawisma_id').on('change', function(){
        $('#rumah_id').val("").trigger("change.select2");
        val = $(this).val();
        optionRumah = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#rumah_id').html(optionRumah);
        }else{
            $('#rumah_id').html("<option value=''>Loading...</option>");
            url = "{{ route('rumahByDasawisma', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionRumah += "<option value='" + value.id + "'>" + value.kepala_rumah + ' / ' + value.alamat_detail +"</li>";
                    });
                    $('#rumah_id').empty().html(optionRumah);

                    if (rumah_id) {
                        $("#rumah_id").val(rumah_id);   
                    } else {
                        $("#rumah_id").val($("#rumah_id option:first").val());
                    }
                }else{
                    $('#rumah_id').html(optionRumah);
                }
            }, 'JSON'); 
        }
    });

    $('#rumah_id').on('change', function(){
        val = $(this).val();
        option = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#no_kk').html(option);
        }else{
            $('#no_kk').html("<option value=''>Loading...</option>");
            url = "{{ route('nokkByRumah', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        option += "<option value='" + value.no_kk + "'>" + value.no_kk + " &nbsp;&nbsp - " + value.nm_kpl_klrga +"</li>";
                    });
                    $('#no_kk').empty().html(option);

                    $("#no_kk").val($("#no_kk option:first").val()).trigger("change.select2");
                }else{
                    $('#no_kk').html(option);
                }
            }, 'JSON'); 
        }
    });
    
    $("input[name='status_pendidkan']").on('change', function(){
        val = $(this).val();
        $('#pendidikanDisplay').show();
        option = "<option value=''>Pilih</option>";
        status_pendidkan = $('input[name="status_pendidkan"]:checked').val();

        if (status_pendidkan == 1) {
            $('#jenjangDisplay').show();
        } else {
            $('#jenjangDisplay').hide();
        }
       
        var tamatSekolah = [{"name":"SD/MI"},{"name":"SMP/Sederajat"},{"name":"SMA/Sederajat"},{"name":"Diploma"},{"name":"S1"},{"name":"S2"},{"name":"S3"}];
        var putusSekolah = [{"name":"SD/MI"},{"name":"SMP/Sederajat"},{"name":"SMA/Sederajat"}];

        if (val == 1) {
            $.each(tamatSekolah, function(index, value){
                option += "<option value='" + value.name + "'>" + value.name +"</li>";
            });
            $('#pendidikan').empty().html(option);   
        } else {
            $.each(putusSekolah, function(index, value){
                option += "<option value='" + value.name + "'>" + value.name +"</li>";
            });
            $('#pendidikan').empty().html(option);
        }
    });

    $('#alamatLuarTangsel').hide();
    $('#terdaftar_dukcapil,#rumah_id,#domisili').on('change', function(){
        terdaftar_dukcapil = $('input[name="terdaftar_dukcapil"]:checked').val();
        rumah_id = $('#rumah_id').val();
        url = "{{ route('getNoKKByKepalaKeluarga', ':id') }}".replace(':id', rumah_id);
        domisili = $('input[name="domisili"]:checked').val();

        if (terdaftar_dukcapil == 1) {
            $("#nik,#no_kk,#domisili").prop({'disabled': false, 'required' : true});
            $('#alamatLuarTangsel').hide();
            if (domisili == 0) {
                $('#alamatLuarTangsel').show();
                $('#almt_luar_tangsel').prop({'required' : true})
            } else {
                $('#almt_luar_tangsel').prop({'required' : false})
                $('#alamatLuarTangsel').hide();
            }
        } else {
            $("#nik,#no_kk").prop({'value': null});
            $("#nik,#no_kk,#domisili").prop({'checked': false,'disabled': true, 'required' : false});
            $('#alamatLuarTangsel').hide();
            $('#no_kk').val("").trigger("change.select2");
        }

        if (rumah_id != "") {
            $.get(url, function(data){
                if (terdaftar_dukcapil == 1) {
                    $('#no_kk').val(data.no_kk)
                }
            }, 'JSON');    
        } else {
            $('#no_kk').val('')
        }
    });

    $("#tgl_lahir,#kelamin").change(function(){
        val = new Date($('#tgl_lahir').val());
        kelamin =  $('input[name="kelamin"]:checked').val();

        // Cek KB
        if (kelamin === 'Perempuan') {
            $('#kb_display').show();
            // $('input[name="kb"]').prop('required', true);
            $('#status_ibu').prop({'disabled': false});
        } else {
            $('#kb_display').hide()
            $('input[name="kb"]').prop('required', false);
            $('#posyandu_display').hide();
            $('#posbindu_display').hide();
            $('#frekuensi_posyandu_display').hide();
            $("#frekuensi_posyandu").prop('required',false);
            $('#frekuensi_posyandu').val(null);
            $('#frekuensi_posbindu_display').hide();
            $("#frekuensi_posbindu").prop('required',false);
            $('#frekuensi_posbindu').val(null);
            $('#status_ibu').prop({'disabled': true, 'required' : false});
        }

        var diff_ms = Date.now() - val.getTime();
        var age_dt = new Date(diff_ms); 
        var age = Math.abs(age_dt.getUTCFullYear() - 1970);
        var ageResult = isNaN(age) === false ? age + ' Tahun' : '. . .' 
        $('#age').html(ageResult);

        // Cek Status Anak
        if (age > 5) {
            $('[name="status_anak"],[name="stunting"]').prop({'disabled': true, 'checked': false})
        }else{
            $('[name="status_anak"],[name="stunting"]').prop({'disabled': false})
        }

        // Cek WUS
        if (age >= 12 && age <= 50 && kelamin === 'Perempuan') {
            $('#wusDisplay').show();
            $('#wus').val(1);
        }else{
            $('#wusDisplay').hide();
            $('#wus').val(0);
        }
    });

    $("#status_kawin,[name='kelamin'],[name='tgl_lahir']").change(function(){
        status_kawin = $('#status_kawin').val();
        kelamin =  $('input[name="kelamin"]:checked').val();
        wus = $('#wus').val();

        if (status_kawin === 'Menikah') {
            if (kelamin === 'Perempuan' && wus == 1) {
                $('#pusDisplay').show();
                $('#pus').val(1);
            }else{
                $('#pusDisplay').hide();
                $('#pus').val(0);
            }
            if (kelamin === 'Laki - laki') {
                $('#pusDisplay').show();
                $('#pus').val(1);
            }
        }else{
            $('#pusDisplay').hide();
            $('#pus').val(0);
        }
    });
</script>
@endpush