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
            <label for="rumah_id" class="col-sm-4 col-form-label fw-bold text-end">Kepala Rumah <span class="text-danger">*</span></label>
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
                <input type="number" name="nik" id="nik" class="form-control" placeholder="16 Digit" autocomplete="off" required>
                <div class="row my-2">
                    <div class="col-sm-6 m-t-6">
                        <input type="radio" value="0" name="domisili" id="domisili" class="form-check-input" required>
                        <label class="form-check-label m-l-10" for="domisili">
                            Luar Tangsel
                        </label>
                    </div>
                    <div class="col-sm-6 m-t-6">
                        <input type="radio" value="1" name="domisili" id="domisili" class="form-check-input" required>
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
                <input type="number" name="no_kk" id="no_kk" class="form-control" placeholder="Nomor Kartu Keluarga" autocomplete="off" required>
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

        <div class="row mt-3">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <button type="submit" class="btn btn-info fs-14" id="btnForm1"><i class="bi bi-arrow-right m-r-8"></i>Selanjutnya</button>
            </div>
        </div>
    </div>
    <div class="col-sm-6">

    </div>
</div>
@push('script')
<script type="text/javascript">
    $("input[name='terdaftar_dukcapil']").change(function(){
        val = $(this).val();
        if (val == 1) {
            $("#nik,#no_kk,#domisili").prop({'disabled': false, 'required' : true});
        } else {
            $("#nik,#no_kk,#domisili").prop({'disabled': true, 'required' : false, 'value' : null});
        }
    });

    $("#tgl_lahir").change(function(){
        val = new Date($(this).val());
        kelamin =  $('input[name="kelamin"]:checked').val();
        console.log(kelamin);

        var diff_ms = Date.now() - val.getTime();
        var age_dt = new Date(diff_ms); 
        var age = Math.abs(age_dt.getUTCFullYear() - 1970);
        $('#age').html(age + ' Tahun');

        if (age >= 12 && age <= 50 && kelamin === 'Perempuan') {
            $('#wusDisplay').show();
            $('#wus').val(1);
        }else{
            $('#wusDisplay').hide();
            $('#wus').val(0);
        }
    });
</script>
@endpush