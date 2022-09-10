<div class="row mt-2">
    <div class="col-md-6">
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Dasawisma</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->rumah->dasawisma->nama }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Rumah</label>
            <label class="col-sm-8 col-form-label">
                {{ $anggota->rumah->kepala_rumah }} &nbsp;&nbsp;&nbsp;
                <a href="#" onclick="getDetailRumah('{{ $anggota->rumah_id }}')" ><span class="badge bg-info p-1">Detail Rumah</span></a> 
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Alamat Rumah</label>
            <label class="col-sm-8 col-form-label">
                {{ $anggota->rumah->alamat_detail }}
                <div class="row p-0">
                    <label class="col-sm-4 col-form-label fw-bold">RT</label>
                    <label class="col-sm-8 col-form-label">{{ $anggota->rumah->rtrw->rt }}</label>
                </div> 
                <div class="row p-0">
                    <label class="col-sm-4 col-form-label fw-bold">RW</label>
                    <label class="col-sm-8 col-form-label">RW {{ $anggota->rumah->rtrw->rw }}</label>
                </div> 
                <div class="row p-0">
                    <label class="col-sm-4 col-form-label fw-bold">Kelurahan</label>
                    <label class="col-sm-8 col-form-label">{{ $anggota->rumah->rtrw->kelurahan->n_kelurahan }}</label>
                </div> 
                <div class="row p-0">
                    <label class="col-sm-4 col-form-label fw-bold">Kecamatan</label>
                    <label class="col-sm-8 col-form-label">{{ $anggota->rumah->rtrw->kecamatan->n_kecamatan }}</label>
                </div> 
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Terdaftar Dukcapil</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->terdaftar_dukcapil == 1)
                    <span class="badge bg-light-success">Ya</span>
                @else
                <span class="badge bg-light-danger">Tidak</span>
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">NIK</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->nik }} / {{ $anggota_detail->domisili == 1 ? 'Tangerang Selatan' : 'Luar Tangsel' }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">No KK</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->no_kk }} ( {{ $anggota->kk ? $anggota->kk->nm_kpl_klrga : '' }} )</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Nama Lengkap</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->nama }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Jenis Kelamin</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->kelamin }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Tempat Lahir</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->tmpt_lahir }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Tanggal Lahir</label>
            <label class="col-sm-8 col-form-label">{{ Carbon\Carbon::createFromFormat('Y-m-d', $anggota->tgl_lahir)->format('d F Y') }}</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Tanggal Meninggal</label>
            <label class="col-sm-8 col-form-label">{{ Carbon\Carbon::createFromFormat('Y-m-d', $anggota_detail->tgl_meninggal)->format('d F Y') }} / <span id="umurMeninggal"></span></label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Sebab Meninggal</label>
            <label class="col-sm-8 col-form-label">{{ $anggota_detail->sebab_meninggal }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Akte Kematian </label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->akte_kematian == 1)
                    <span class="badge bg-light-success">Ya</span>
                @else
                <span class="badge bg-light-danger">Tidak</span>
                @endif
            </label>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    // get Umur
    var tgl_lahir = new Date("{{ $anggota->tgl_lahir }}");  
    var tgl_meninggal = new Date("{{ $anggota_detail->tgl_meninggal }}");  
    var diff_ms = tgl_lahir.getTime() - tgl_meninggal.getTime();
    var age_dt = new Date(diff_ms); 
    var age = Math.abs(age_dt.getUTCFullYear() - 1970);
    var ageResult = isNaN(age) === false ? age + ' Tahun' : '. . .' 
    $('#umurMeninggal').html(ageResult);
</script>
@endpush