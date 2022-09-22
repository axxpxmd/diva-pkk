@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="card">  
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Data Rumah</h5>
        <div class="card-body fs-14">
            <div class="my-3">
                <a href="{{ route('rumah.index') }}" class="fs-14 text-danger fw-bold m-r-10"><i class="bi bi-arrow-left m-r-8"></i>Kembali</a>
                <a href="{{ route('cetakRumah', $data->id) }}" target="blank" class="btn btn-sm btn-info m-r-5"><i class="bi bi-file-pdf-fill m-r-8"></i>Data Rumah</a>
            </div>
            <hr>
            <div class="row mt-2">
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Dasawisma</label>
                        <label class="col-sm-8 col-form-label">{{ $data->dasawisma->nama }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Alamat Detail</label>
                        <label class="col-sm-8 col-form-label">
                            {{ $data->alamat_detail }}
                            <div class="row p-0">
                                <label class="col-sm-4 col-form-label fw-bold">RT</label>
                                <label class="col-sm-8 col-form-label">{{ $data->rtrw->rt }}</label>
                            </div> 
                            <div class="row p-0">
                                <label class="col-sm-4 col-form-label fw-bold">RW</label>
                                <label class="col-sm-8 col-form-label">RW {{ $data->rtrw->rw }}</label>
                            </div> 
                            <div class="row p-0">
                                <label class="col-sm-4 col-form-label fw-bold">Kelurahan</label>
                                <label class="col-sm-8 col-form-label">{{ $data->rtrw->kelurahan->n_kelurahan }}</label>
                            </div> 
                            <div class="row p-0">
                                <label class="col-sm-4 col-form-label fw-bold">Kecamatan</label>
                                <label class="col-sm-8 col-form-label">{{ $data->rtrw->kecamatan->n_kecamatan }}</label>
                            </div> 
                        </label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Kepala Rumah</label>
                        <label class="col-sm-8 col-form-label">{{ $data->kepala_rumah }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Jamban Rumah</label>
                        <label class="col-sm-8 col-form-label">{{ $data->jamban == 0 ? 'Tidak Punya' : $data->jamban.' Buah' }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Sumber Air</label>
                        <label class="col-sm-8 col-form-label">
                            @foreach(json_decode($data->sumber_air) as $value)
                                <li>{{ $value }}</li>
                            @endforeach
                        </label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Pembuangan Sampah</label>
                        <label class="col-sm-8 col-form-label">{{ $data->tempat_smph == 1 ? 'Ya' : 'Tidak' }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Pembuangan Limbah</label>
                        <label class="col-sm-8 col-form-label">{{ $data->saluran_pmbngn == 1 ? 'Ya' : 'Tidak' }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Stiker P4K</label>
                        <label class="col-sm-8 col-form-label">{{ $data->stiker_p4k == 1 ? 'Ya' : 'Tidak' }}</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Kriteria Rumah</label>
                        <label class="col-sm-8 col-form-label">
                            @if ($data->kriteria_rmh == 1)
                                <span class="badge bg-light-success">Sehat</span>
                            @else
                                <span class="badge bg-light-danger">Tidak Sehat</span>
                            @endif
                        </label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Layak Huni</label>
                        <label class="col-sm-8 col-form-label">
                            @if ($data->layak_huni == 1)
                                <span class="badge bg-light-success">Layak</span>
                            @else
                                <span class="badge bg-light-danger">Tidak Layak</span>
                            @endif
                        </label>
                    </div>
                </div>
            </div>
            <div class="bg-light-secondary p-2 rounded mt-2">
                <h6 class="text-center text-black m-1">Detail Jumlah Anggota Rumah</h6>
            </div>
            <div class="row mt-2">
                <div class="col-md-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Jumlah KK</label>
                        <label class="col-sm-8 col-form-label">{{ $data->kk->count() }} Kartu Keluarga</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Jumlah Anggota</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota->count() }} Orang</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Laki - Laki</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(1)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Perempuan</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(2)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Balita</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(3)->count() }} Anak</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">PUS</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(4)->count() }} Pasang</label>
                    </div> 
                </div>
                <div class="col-md-6">
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">WUS</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(5)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">3 Buta</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(6)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Ibu Hamil</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(7)->count() }} Orang</label>
                    </div>
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Ibu Menyusui</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(8)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Berkebutuhan Khusus</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(9)->count() }} Orang</label>
                    </div> 
                    <div class="row p-0">
                        <label class="col-sm-4 col-form-label fw-bold">Lansia</label>
                        <label class="col-sm-8 col-form-label">{{ $data->anggota(10)->count() }} Orang</label>
                    </div> 
                </div>
            </div>
        </div>
    </div>
    <div class="mb-3 text-right">
        <a href="#" onclick="add()" class="btn btn-sm btn-success px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data</a>
    </div>
    <div class="card">  
        <h5 class="card-header bg-info text-white mb-2 p-3 fs-18">Daftar Kartu Keluarga</h5>
        <div class="card-body">
             <div class="table-responsive">
                <table id="dataTable" class="table data-table display nowrap table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No KK</th>
                            <th>Kepala Keluarga</th>
                            <th>Domisili</th>
                            <th>Tahun Input</th>
                            <th>Total Anggota</th>
                            <th>Cetak KK</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span id="txtTitle"></span> Data {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" class="fs-14 needs-validation" novalidate>
                    {{ method_field('POST') }}
                    <input type="text" class="d-none" id="id" name="id"/>
                    <input type="text" class="d-none" id="rumah_id" name="rumah_id" value="{{ $id }}">
                    <div id="alert"></div>
                    <div class="row mb-2">
                        <label for="no_kk" class="col-sm-3 col-form-label fw-bold">No KK <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="number" name="no_kk" id="no_kk" class="form-control" placeholder="Nomor Kartu Keluarga" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nm_kpl_klrga" class="col-sm-3 col-form-label fw-bold">Kepala Keluarga <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="nm_kpl_klrga" id="nm_kpl_klrga" class="form-control" placeholder="Nama Kepala Keluarga" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="domisili" class="col-sm-3 col-form-label fw-bold">Domisili <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="domisili" id="domisili">
                                <option value="">Pilih</option>
                                <option value="0">Luar Tangerang Selatan</option>
                                <option value="1">Tangerang Selatan</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="thn_input" class="col-sm-3 col-form-label fw-bold">Tahun <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="number" name="thn_input" id="thn_input" class="form-control" placeholder="Tahun Input Data" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9">
                            <button type="submit" class="btn btn-success fs-14" id="btnSave" title="Simpan Data"><i class="bi bi-save m-r-8"></i>Simpan <span id="txtSave"></span></button>
                            <a href="#" onclick="add()" class="m-l-5 text-danger fw-bold  fs-14" title="Kosongkan Form"><i class="bi bi-arrow-clockwise m-r-8"></i>Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalFormAddAnggota" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span id="txtTitle"></span> Data {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <a target="_blank" id="addHidup" class="btn btn-sm btn-block btn-outline-success px-2 mb-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Hidup</a>
                <a target="_blank" id="addMeninggal" class="btn btn-sm btn-block btn-outline-danger px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Meninggal</a>
            </div>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    var table = $('#dataTable').dataTable({
        scrollX: true,
        processing: true,
        serverSide: true,
        order: [ 0, 'asc' ],
        pageLength: 25,
        ajax: {
            url: "{{ route('rumah.show', $id) }}",
            method: 'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'no_kk', name: 'no_kk'},
            {data: 'nm_kpl_klrga', name: 'nm_kpl_klrga'},
            {data: 'domisili', name: 'domisili'},
            {data: 'thn_input', name: 'thn_input', className: 'text-center'},
            {data: 'total_anggota', name: 'total_anggota', className: 'text-center'},
            {data: 'data_kk', name: 'data_kk', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });

    $('.select2').select2({
        dropdownParent: $('#modalForm')
    });

    function openForm(){
        $('#modalForm').modal('show');
    }

    function sendNoKK(no_kk){
        rumah_id = "{{ $data->id }}"

        params= "&rumah_id=" + rumah_id + "&no_kk=" + no_kk

        urlHidup = "{{ route('anggota-keluarga.create', 'status=1') }}" + params
        urlMeninggal = "{{ route('anggota-keluarga.create', 'status=0') }}" + params

        $('#addHidup').attr('href', urlHidup)
        $('#addMeninggal').attr('href', urlMeninggal)
    }

    function add(){
        openForm();
        save_method = "add";
        $('#form').trigger('reset');
        $('input[name=_method]').val('POST');
        $('#txtTitle').html('Tambah');
        $('#txtSave').html('');
        $('#alert').html('');
    }

    function edit(id){
        $('#loading').show();
        $.get("{{ Route('rumah.editKK', ':id') }}".replace(':id', id), function(data){
            save_method = 'edit';
            $('#txtTitle').html('Edit');
            $('#txtSave').html("Perubahan");
            $('input[name=_method]').val('PATCH');
            $('#alert').html('');
            $('#loading').hide();
            openForm();
            $('#id').val(data.id);
            $('#no_kk').val(data.no_kk);
            $('#nm_kpl_klrga').val(data.nm_kpl_klrga);
            $('#domisili').val(data.domisili).trigger("change.select2");
            $('#thn_input').val(data.thn_input);
        });
    }

    $('#form').on('submit', function (event) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }else{    
            $('#loading').show();
            $('#alert').html('');
            $('#btnSave').attr('disabled', true);
            
            url = (save_method == 'add') ? "{{ route('rumah.storeKK') }}" : "{{ route('rumah.updateKK', ':id') }}".replace(':id', $('#id').val());
            $.post(url, $(this).serialize(), function(data){
                $('#alert').html("<div class='alert alert-success alert-dismissible' role='alert'><strong>Sukses!</strong> " + data.message + "</div>");
                table.api().ajax.reload();
                if(save_method == 'add') $('#form').trigger('reset');
            },'json').fail(function(data){
                err = ''; respon = data.responseJSON;
                $.each(respon.errors, function(index, value){
                    err += "<li>" + value +"</li>";
                });
                $('#alert').html("<div class='alert alert-danger alert-dismissible' role='alert'>" + respon.message + "<ol class='pl-3 m-0'>" + err + "</ol></div>");
            }).always(function(){
                $('#loading').hide();
                $('#btnSave').removeAttr('disabled');
            });
            return false;
        }
        $(this).addClass('was-validated');
    });

    function remove(id){
        $.confirm({
            title: 'Konfirmasi',
            content: 'Apakah Anda yakin ingin menghapus data ini ?',
            icon: 'bi bi-question text-danger',
            theme: 'modern',
            closeIcon: true,
            animation: 'scale',
            type: 'red',
            buttons: {
                ok: {
                    text: "ok!",
                    btnClass: 'btn-primary',
                    keys: ['enter'],
                    action: function(){
                        $.post("{{ route('rumah.destroyKK', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
                            table.api().ajax.reload();
                            success(data.message)
                        }, "JSON").fail(function(){
                            reload();
                        });
                    }
                },
                cancel: function(){}
            }
        });
    }
</script>
@endpush