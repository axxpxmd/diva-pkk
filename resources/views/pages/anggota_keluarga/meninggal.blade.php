<form class="form-stepper fs-14" id="form-meninggal" method="POST" enctype="multipart/form-data" novalidate>
    {{ method_field('POST') }}
    <div class="row mt-2">
        <div class="col-sm-6">
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label fw-bold text-end">Dasawisma <span class="text-danger">*</span></label>
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
                <label class="col-sm-4 col-form-label fw-bold text-end">Rumah <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <select class="form-control select2" name="rumah_id" id="rumah_id" required>
                        <option value="">Pilih</option>
                        @foreach ($rumah as $i)
                            <option value="{{ $i->id }}" {{ $i->id == $rumah_id ? 'selected' : '-' }}>{{ $i->kepala_rumah }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                        Silahkan pilih kepala rumah.
                    </div>
                </div>
            </div>
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
                    <input type="number" name="nik" id="nik" class="form-control" placeholder="16 Digit" autocomplete="off">
                    <div class="row my-2">
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
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="row mb-2">
                <label class="col-sm-4 col-form-label text-end fw-bold">Tanggal Meninggal <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <div class="row">
                        <div class="col-sm-">
                            <input type="date" name="tgl_meninggal" id="tgl_meninggal" class="form-control" placeholder="Tanggal Meninggal" autocomplete="off" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <label class="col-sm-4 col-form-label fw-bold text-end">Sebab Meninggal <span class="text-danger">*</span></label>
                <div class="col-sm-8">
                    <select class="select2 form-select" id="sebab_meninggal" name="sebab_meninggal" required>
                        <option value="">Pilih</option>
                        <option value="Hamil">Hamil</option>
                        <option value="Sakit">Sakit</option>
                        <option value="Lahir mati">Lahir mati</option>
                    </select>
                    <div class="invalid-feedback">
                        Silahkan pilih sebab meninggal.
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <label class="col-sm-4 col-form-label text-end fw-bold">Akte Kematian <span class="text-danger">*</span></label>
                <div class="col-sm-4 m-t-6">
                    <input type="radio" value="0" name="akte_kematian" id="akte_kematian" class="form-check-input" required>
                    <label class="form-check-label m-l-10">
                        Tidak
                    </label>
                </div>
                <div class="col-sm-4 m-t-6">
                    <input type="radio" value="1" name="akte_kematian" id="akte_kematian" class="form-check-input" required>
                    <label class="form-check-label m-l-10">
                        Ya
                    </label>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                    <button type="submit" class="btn btn-block btn-info fs-14"><i class="bi bi-save m-r-8"></i>Simpan</button>
                </div>
            </div>
        </div>
    </div>
</form>
@push('script')
<script type="text/javascript">
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

    $('#terdaftar_dukcapil,#rumah_id').on('change', function(){
        terdaftar_dukcapil = $('input[name="terdaftar_dukcapil"]:checked').val();
        rumah_id = $('#rumah_id').val();
        url = "{{ route('getNoKKByKepalaKeluarga', ':id') }}".replace(':id', rumah_id);

        if (terdaftar_dukcapil == 1) {
            $("#nik,#no_kk,#domisili").prop({'disabled': false, 'required' : true});
        } else {
            $("#nik,#no_kk").prop({'value': null});
            $("#nik,#no_kk,#domisili").prop({'checked': false,'disabled': true, 'required' : false});
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

        // Get Usia
        var diff_ms = Date.now() - val.getTime();
        var age_dt = new Date(diff_ms); 
        var age = Math.abs(age_dt.getUTCFullYear() - 1970);
        var ageResult = isNaN(age) === false ? age + ' Tahun' : '. . .' 
        $('#age').html(ageResult);
    });
</script>
@endpush