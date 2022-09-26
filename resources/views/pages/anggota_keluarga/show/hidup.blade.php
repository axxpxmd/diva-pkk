@php
    $ya = '<span class="badge bg-light-success">Ya</span>';
    $tidak = '<span class="badge bg-light-danger">Tidak</span>';
@endphp
<div class="my-3">
    <a href="{{ route('anggota-keluarga.index') }}" class="fs-14 text-danger fw-bold m-r-10"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
    <a href="{{ route('cetakAnggota', $anggota->id) }}" target="blank" class="btn btn-sm btn-info m-r-5 mb-5-m"><i class="bi bi-file-pdf-fill m-r-8"></i>Data Warga</a>
    <a href="{{ route('cetakKegiatanWarga', $anggota->id) }}" target="blank" class="btn btn-sm btn-success"><i class="bi bi-file-pdf-fill m-r-8"></i>Kegiatan Warga</a>
</div>
<div class="bg-light-secondary p-2 rounded mt-2">
    <h6 class="text-center text-black m-1">Data 1 : Berisikan data diri anggota keluarga</h6>
</div>
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
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">NIK</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->nik }} / {{ $anggota_detail->domisili == 1 ? 'Tangerang Selatan' : 'Luar Tangsel' }}</label>
        </div>
        @if ($anggota_detail->domisili == 0)
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Alamat Luar Tangsel</label>
            <label class="col-sm-8 col-form-label">{{ $anggota_detail->almt_luar_tangsel }}</label>
        </div>
        @endif
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
            <label class="col-sm-4 col-form-label fw-bold">Wanita Usia Subur</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->wus == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Pasangan Usia Subur</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->pus == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Tempat Lahir</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->tmpt_lahir }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Tanggal Lahir</label>
            <label class="col-sm-8 col-form-label">{{ Carbon\Carbon::createFromFormat('Y-m-d', $anggota->tgl_lahir)->format('d F Y') }} / <span id="umur"></span></label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Akte Kelahiran</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->akta_kelahiran }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Status Perkawinan</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->status_kawin }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Status Keluarga</label>
            <label class="col-sm-8 col-form-label">
                @foreach(json_decode($anggota->status_dlm_klrga) as $value)
                    <li>{{ $value }}</li>
                @endforeach
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Agama</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->agama }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Pendidikan</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->status_pendidkan == 1 ? 'Tamat Sekolah' : 'Putus Sekolah' }} ( {{ $anggota->pendidikan }}) </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Pekerjaan</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->pekerjaan }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Jabatan</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->jabatan }}</label>
        </div>
    </div>
</div>
<div class="bg-light-secondary p-2 rounded mt-2">
    <h6 class="text-center text-black m-1">Data 2 : Berisikan data kesehatan anggota keluarga</h6>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Peserta BPJS</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota->bpjs == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Asuransi Lainnya</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota->asuransi_lainnya)
                    @foreach(json_decode($anggota->asuransi_lainnya) as $value)
                        <li>{{ $value }}</li>
                    @endforeach
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Akseptor KB</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota->kb)
                    {{ $anggota->kb }}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Aktif Posyandu</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->aktif_posyandu ? $anggota->aktif_posyandu : '-' }} / Bulan</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Aktif Posbindu</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->aktif_posbindu ? $anggota->aktif_posbindu : '-' }} / Bulan</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Status Ibu</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->status_ibu ? $anggota->status_ibu : '-' }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Status Anak</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->status_anak ? $anggota->status_anak : '-' }}</label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Stunting</label>
            <label class="col-sm-8 col-form-label">{{ $anggota->stunting ? $anggota->stunting : '-' }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Kebutuhan Khusus </label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota->kbthn_khusus == 'Ya')
                    {!! $ya !!} / {!! $anggota_detail->jenis_kbthn_khusus !!}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Penyandang 3 Buta </label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota->buta == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
                @if ($anggota_detail->jenis_buta)
                    @foreach(json_decode($anggota_detail->jenis_buta) as $value)
                    <li class="mt-2">{{ $value }}</li>
                    @endforeach
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Makanan Pokok</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota->makanan_pokok == 0)
                    Non-Beras
                @elseif($anggota->makanan_pokok == 1)
                    Beras
                @elseif($anggota->makanan_pokok == 2)
                    Berasn dan Non-Beras
                @endif    
            </label>
        </div>
    </div>
</div>
<div class="bg-light-secondary p-2 rounded mt-2">
    <h6 class="text-center text-black m-1">Data 3 : Berisikan data kegiatan anggota keluarga</h6>
</div>
<div class="row mt-2">
    <div class="col-md-6">
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Program Bina Balita</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->prgrm_bina_balita == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Tabungan</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->tabungan == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Kelompok Belajar</label>
            <label class="col-sm-8 col-form-label">{{ $anggota_detail->klmpk_belajar }}</label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">PAUD / Sejenis</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->paud == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Kegiatan Koperasi</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->kgtn_koperasi == 1)
                    {!! $ya !!} / {{ $anggota_detail->jns_kgtn_koperasi  }}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Kegiatan Pancasila</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->kgtn_pancasila == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
                @if ($anggota_detail->jns_kgtn_pancasila)
                    @foreach(json_decode($anggota_detail->jns_kgtn_pancasila) as $value)
                        <li class="mt-2">
                            {{ $value }}
                            @if ($value == 'Kegiatan Keagamaan')
                                ( {{ $anggota_detail->jns_kgtn_keagamaan }} )
                            @endif
                        </li>
                    @endforeach
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Gotong Royong</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->gotong_royong == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
                @if ($anggota_detail->jns_gotong_royong)
                    @foreach(json_decode($anggota_detail->jns_gotong_royong) as $value)
                        <li class="mt-2">{{ $value }}</li>
                    @endforeach
                @endif
            </label>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Hatinya PKK</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->hatinya_pkk == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
                @if ($anggota_detail->jns_hatinya_pkk)
                    @foreach(json_decode($anggota_detail->jns_hatinya_pkk) as $value)
                        <li class="mt-2">{{ $value }}</li>
                    @endforeach
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">UP2K</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->industri_rmh_up2k == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
                @if ($anggota_detail->industri_rmh_up2k)
                    @foreach(json_decode($anggota_detail->jns_industri_rmh_up2k) as $value)
                        <li class="mt-2">{{ $value }}</li>
                    @endforeach
                @endif
            </label>
        </div>
        <div class="row p-0">
            <label class="col-sm-4 col-form-label fw-bold">Aktivitas Kesehatan (PHBS)</label>
            <label class="col-sm-8 col-form-label">
                @if ($anggota_detail->kgtn_kshtn_lingkungan == 1)
                    {!! $ya !!}
                @else
                    {!! $tidak !!}
                @endif
            </label>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    // get Umur
    var tgl_lahir = new Date("{{ $anggota->tgl_lahir }}");  
    var diff_ms = Date.now() - tgl_lahir.getTime();
    var age_dt = new Date(diff_ms); 
    var age = Math.abs(age_dt.getUTCFullYear() - 1970);
    var ageResult = isNaN(age) === false ? age + ' Tahun' : '. . .' 
    $('#umur').html('Umur : ' + ageResult);
</script>
@endpush