@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="mb-3 text-right">
        {{-- <a href="{{ route('rumah.create') }}" class="btn btn-sm btn-success px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data</a> --}}
        <a href="#" onclick="add()" class="btn btn-sm btn-success px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data</a>
    </div>
    <div class="card">  
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table data-table table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kepala Rumah</th>
                            <th>Dasawisma</th>
                            <th>Alamat</th>
                            <th>Kriteri</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span id="txtTitle"></span> Data {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="needs-validation fs-14" id="form" method="POST"  enctype="multipart/form-data" novalidate>
                    {{ method_field('POST') }}
                    <input type="text" class="d-none" id="id" name="id"/>
                    <div id="alert"></div>
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
                                    <input type="radio" value="0" name="tempat_smph" id="tempat_smph_off" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="tempat_smph">
                                        Tidak
                                    </label>
                                </div>
                                <div class="col-sm-4 m-t-6">
                                    <input type="radio" value="1" name="tempat_smph" id="tempat_smph_on" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="tempat_smph">
                                        Ya
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="saluran_pmbngn" class="col-sm-4 col-form-label text-end fw-bold">Pembuangan Limbah <span class="text-danger">*</span></label>
                                <div class="col-sm-4 m-t-6">
                                    <input type="radio" value="0" name="saluran_pmbngn" id="saluran_pmbngn_off" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="saluran_pmbngn">
                                        Tidak
                                    </label>
                                </div>
                                <div class="col-sm-4 m-t-6">
                                    <input type="radio" value="1" name="saluran_pmbngn" id="saluran_pmbngn_on" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="saluran_pmbngn">
                                        Ya
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="stiker_p4k" class="col-sm-4 col-form-label text-end fw-bold">Stiker P4K <span class="text-danger">*</span></label>
                                <div class="col-sm-4 m-t-6">
                                    <input type="radio" value="0" name="stiker_p4k" id="stiker_p4k_off" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="stiker_p4k">
                                        Tidak
                                    </label>
                                </div>
                                <div class="col-sm-4 m-t-6">
                                    <input type="radio" value="1" name="stiker_p4k" id="stiker_p4k_on" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="stiker_p4k">
                                        Ya
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="kriteria_rmh" class="col-sm-4 col-form-label text-end fw-bold">Kriteria Rumah <span class="text-danger">*</span></label>
                                <div class="col-sm-4 m-t-6">
                                    <input type="radio" value="0" name="kriteria_rmh" id="kriteria_rmh_off" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="kriteria_rmh">
                                        Kurang Sehat
                                    </label>
                                </div>
                                <div class="col-sm-4 m-t-6">
                                    <input type="radio" value="1" name="kriteria_rmh" id="kriteria_rmh_on" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="kriteria_rmh">
                                        Sehat
                                    </label>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="layak_huni" class="col-sm-4 col-form-label text-end fw-bold">Layak Huni <span class="text-danger">*</span></label>
                                <div class="col-sm-4 m-t-6">
                                    <input type="radio" value="0" name="layak_huni" id="layak_huni_off" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="layak_huni">
                                        Tidak
                                    </label>
                                </div>
                                <div class="col-sm-4 m-t-6">
                                    <input type="radio" value="1" name="layak_huni" id="layak_huni_on" class="form-check-input" required>
                                    <label class="form-check-label m-l-10" for="layak_huni">
                                        Ya
                                    </label>
                                </div>
                            </div>
                            
                            <div class="row mt-3">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8">
                                    <button type="submit" class="btn btn-success fs-14" id="btnSave" title="Simpan Data"><i class="bi bi-save m-r-8"></i>Simpan <span id="txtSave"></span></button>
                                    <a href="#" onclick="add()" class="m-l-5 text-danger fw-bold  fs-14" title="Kosongkan Form"><i class="bi bi-arrow-clockwise m-r-8"></i>Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
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
            url: "{{ route('rumah.index') }}",
            method: 'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'kepala_rumah', name: 'kepala_rumah'},
            {data: 'dasawisma_id', name: 'dasawisma_id'},
            {data: 'alamat_detail', name: 'alamat_detail'},
            {data: 'kriteria_rmh', name: 'kriteria_rmh',  className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });

    $('.select2').select2({
        dropdownParent: $('#modalForm')
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

    function openForm(){
        $('#modalForm').modal('show');
    }

    function add(){
        openForm();
        reset();
        save_method = "add";
        $('input[name=_method]').val('POST');
        $('#txtTitle').html('Tambah');
        $('#txtSave').html('');
        $('#alert').html('');
    }

    function edit(id){
        $('#loading').show();
        $.get("{{ Route('rumah.edit', ':id') }}".replace(':id', id), function(data){
            save_method = 'edit';
            $('#txtTitle').html('Edit');
            $('#txtSave').html("Perubahan");
            $('input[name=_method]').val('PATCH');
            $('#alert').html('');
            $('#loading').hide();
            openForm();
            $('#id').val(data.id);
            $('#dasawisma_id').val(data.dasawisma_id).trigger("change.select2");
            $('#rtrw_id').val(data.rtrw_id).trigger("change.select2");
            $('#alamat_detail').val(data.alamat_detail);
            $('#kepala_rumah').val(data.kepala_rumah);
            $('#jamban').val(data.jamban);
          
            // CheckBox
            if (data.sumber_air.includes("PDAM")) {
                $('#pdam').prop('checked', true);
            }
            if (data.sumber_air.includes("Sumur")) {
                $('#sumur').prop('checked', true);
            }
            if (data.sumber_air.includes("Sungai")) {
                $('#sungai').prop('checked', true);
            }
            sumberAirs = data.sumber_air;
            sumberAirToArrays = sumberAirs.replaceAll('[', '').replaceAll(']', '').replaceAll('"', '').split(",")
            sumberAirLength = sumberAirToArrays.length;
            selectSumberAir = sumberAirToArrays.filter(sumberAir => sumberAir.length > 6);
            if (selectSumberAir.length != 0) {
                $('#lainnya').prop('checked', true);
                $('#lainnya_value').show();
                $('#lainnya_value').val(selectSumberAir[0]);
                $('#lainnya').val(selectSumberAir[0]);
            }

            // Radio
            if (data.tempat_smph == 1) {
                $("#tempat_smph_on").prop("checked", true);
            } else {
                $("#tempat_smph_off").prop("checked", true);
            }
            if (data.saluran_pmbngn == 1) {
                $("#saluran_pmbngn_on").prop("checked", true);
            } else {
                $("#saluran_pmbngn_off").prop("checked", true);
            }
            if (data.stiker_p4k == 1) {
                $("#stiker_p4k_on").prop("checked", true);
            } else {
                $("#stiker_p4k_off").prop("checked", true);
            }
            if (data.kriteria_rmh == 1) {
                $("#kriteria_rmh_on").prop("checked", true);
            } else {
                $("#kriteria_rmh_off").prop("checked", true);
            }
            if (data.layak_huni == 1) {
                $("#layak_huni_on").prop("checked", true);
            } else {
                $("#layak_huni_off").prop("checked", true);
            }
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
            
            url = (save_method == 'add') ? "{{ route('rumah.store') }}" : "{{ route('rumah.update', ':id') }}".replace(':id', $('#id').val());
            $.post(url, $(this).serialize(), function(data){
                $('#alert').html("<div class='alert alert-success alert-dismissible' role='alert'><strong>Sukses!</strong> " + data.message + "</div>");
                table.api().ajax.reload();
                if(save_method == 'add') reset();
                if(save_method == 'edit'){
                    setTimeout(function(){
                        $('#modalForm').modal('toggle')
                    }, 1000);
                }
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
                        $.post("{{ route('rumah.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
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