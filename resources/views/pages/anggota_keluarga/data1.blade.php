<div class="row mt-2">
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
            <label for="rumah_id" class="col-sm-4 col-form-label fw-bold text-end">Rumah <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <select class="select2 form-select" id="rumah_id" name="rumah_id" required>
                    <option value="">Pilih</option>
                    @foreach ($rumah as $i)
                        <option value="{{ $i->id }}">{{ $i->kepala_rumah }} - {{ $i->alamat_detail }}</option>
                    @endforeach
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih kepala rumah.
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="terdaftar_dukcapil" class="col-sm-4 col-form-label text-end fw-bold">Terdaftar Dukcapil <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="terdaftar_dukcapil" id="terdaftar_dukcapil" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="terdaftar_dukcapil">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="terdaftar_dukcapil" id="terdaftar_dukcapil" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="terdaftar_dukcapil">
                    Ya
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <label for="nik" class="col-sm-4 col-form-label text-end fw-bold">NIK</label>
            <div class="col-sm-8">
                <input type="number" name="nik" id="nik" class="form-control" placeholder="16 Digit" autocomplete="off">
                <div class="row my-2">
                    <div class="col-sm-6 m-t-6">
                        <input type="radio" value="0" name="domisili" id="domisili" class="form-check-input">
                        <label class="form-check-label m-l-10" for="domisili">
                            Luar Tangsel
                        </label>
                    </div>
                    <div class="col-sm-6 m-t-6">
                        <input type="radio" value="1" name="domisili" id="domisili" class="form-check-input">
                        <label class="form-check-label m-l-10" for="domisili">
                            Tangsel
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <label for="no_kk" class="col-sm-4 col-form-label text-end fw-bold">No KK</label>
            <div class="col-sm-8">
                <input type="number" name="no_kk" id="no_kk" class="form-control" placeholder="Nomor Kartu Keluarga" autocomplete="off">
                <span></span>
            </div>
        </div>
        <div class="row mb-2">
            <label for="nama" class="col-sm-4 col-form-label text-end fw-bold">Nama Lengkap <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama Lengkap" autocomplete="off" required>
            </div>
        </div>
        <div class="row mb-2">
            <label for="kelamin" class="col-sm-4 col-form-label text-end fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Laki - laki" name="kelamin" id="kelamin" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="kelamin">
                    Laki - laki
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Perempuan" name="kelamin" id="kelamin" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="kelamin">
                    Perempuan
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <label for="tmpt_lahir" class="col-sm-4 col-form-label text-end fw-bold">Tempat Lahir <span class="text-danger">*</span></label>
            <div class="col-sm-8">
                <textarea type="text" name="tmpt_lahir" id="tmpt_lahir" placeholder="Tempat Lahir" class="form-control" autocomplete="off" required></textarea>
            </div>
        </div>
        <div class="row mb-2">
            <label for="tgl_lahir" class="col-sm-4 col-form-label text-end fw-bold">Tanggal Lahir <span class="text-danger">*</span></label>
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
            <label for="akta_kelahiran" class="col-sm-4 col-form-label text-end fw-bold">Akte Kelahiran <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Tidak" name="akta_kelahiran" id="akta_kelahiran" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="akta_kelahiran">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="Ya" name="akta_kelahiran" id="akta_kelahiran" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="akta_kelahiran">
                    Ya
                </label>
            </div>
            <div class="col-sm-3 m-t-6">
                <input type="radio" value="Proses" name="akta_kelahiran" id="akta_kelahiran" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="akta_kelahiran">
                    Proses
                </label>
            </div>
        </div>
        <div class="row">
            <label for="status_kawin" class="col-sm-4 col-form-label fw-bold text-end">Status Perkawinan <span class="text-danger">*</span></label>
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
        <div class="row">
            <label for="status_dlm_klrga" class="col-sm-4 col-form-label text-end fw-bold">Status Keluarga <span class="text-danger">*</span></label>
            <div class="col-sm-3 m-t-6">
                <input type="checkbox" name="status_dlm_klrga[]" id="status_dlm_klrga" value="Kepala Keluarga" class="form-check-input">
                <label class="form-check-label m-l-10" for="status_dlm_klrga">
                    Kepala Keluarga
                </label>
            </div>
            <div class="col-sm-3 m-t-6">
                <input type="checkbox" name="status_dlm_klrga[]" id="status_dlm_klrga" value="Suami" class="form-check-input">
                <label class="form-check-label m-l-10" for="status_dlm_klrga">
                    Suami
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="checkbox" name="status_dlm_klrga[]" id="status_dlm_klrga" value="Istri" class="form-check-input">
                <label class="form-check-label m-l-10" for="status_dlm_klrga">
                    Istri
                </label>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-sm-4"></div>
            <div class="col-sm-3 m-t-6">
                <input type="checkbox" name="status_dlm_klrga[]" id="status_dlm_klrga" value="Anak" class="form-check-input">
                <label class="form-check-label m-l-10" for="status_dlm_klrga">
                    Anak
                </label>
            </div>
            <div class="col-sm-3 m-t-6">
                <input type="checkbox" name="status_dlm_klrga[]" id="status_dlm_klrga" value="Lansia" class="form-check-input">
                <label class="form-check-label m-l-10" for="status_dlm_klrga">
                    Lansia
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="checkbox" name="status_dlm_klrga[]" id="status_dlm_klrga" value="Lainnya" class="form-check-input">
                <label class="form-check-label m-l-10" for="status_dlm_klrga">
                    Lainnya
                </label>
            </div>
        </div>
        <div class="row mb-2">
            <label for="agama" class="col-sm-4 col-form-label fw-bold text-end">Agama <span class="text-danger">*</span></label>
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
            <label for="status_pendidkan" class="col-sm-4 col-form-label text-end fw-bold">Pendidikan <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="status_pendidkan" id="status_pendidkan" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="status_pendidkan">
                    Putus Sekolah
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="status_pendidkan" id="status_pendidkan" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="status_pendidkan">
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
            <label for="pekerjaan" class="col-sm-4 col-form-label fw-bold text-end">Pekerjaan <span class="text-danger">*</span></label>
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
            <label for="jabatan" class="col-sm-4 col-form-label text-end fw-bold">Jabatan <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Managerial" name="jabatan" id="jabatan" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="jabatan">
                    Managerial
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="Staff" name="jabatan" id="jabatan" class="form-check-input" required>
                <label class="form-check-label m-l-10" for="jabatan">
                    Staff
                </label>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <button type="submit" class="btn btn-block btn-info fs-14" id="btnForm1"><i class="bi bi-arrow-right m-r-8"></i>Selanjutnya</button>
            </div>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
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

    $('#terdaftar_dukcapil,#rumah_id').on('change', function(){
        terdaftar_dukcapil = $('input[name="terdaftar_dukcapil"]:checked').val();
        rumah_id = $('#rumah_id').val();
        url = "{{ route('getNoKKByKepalaKeluarga', ':id') }}".replace(':id', rumah_id);

        if (terdaftar_dukcapil == 1) {
            $("#nik,#no_kk,#domisili").prop({'disabled': false, 'required' : true});
        } else {
            $("#nik,#no_kk,#domisili").prop({'disabled': true, 'required' : false, 'value' : null});
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

        var diff_ms = Date.now() - val.getTime();
        var age_dt = new Date(diff_ms); 
        var age = Math.abs(age_dt.getUTCFullYear() - 1970);
        var ageResult = isNaN(age) === false ? age + ' Tahun' : '. . .' 
        $('#age').html(ageResult);

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
        console.log(status_kawin);

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