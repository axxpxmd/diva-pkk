@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="mb-3 text-right">
        <a href="#" onclick="add()" class="btn btn-sm btn-success px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data</a>
    </div>
    <div class="card my-2">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 px-0">
                    @include('layouts.alamat_filter')
                    <div class="row mb-4">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-8">
                            <button class="btn btn-success btn-sm mr-2" onclick="pressOnChange()"><i class="bi bi-filter m-r-8"></i>Filter</button>
                        </div> 
                    </div>
                </div>
                <div class="col-md-6 px-0">
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-2">
                            <div class="p-2 bg-info text-white rounded text-center">
                                <p class="mb-0 fw-bolder fs-16 mb-1">Jumlah RT</p>
                                <p class="mb-0 fs-14">{{ $totalRT }}</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-2">
                            <div class="p-2 bg-danger text-white rounded text-center">
                                <p class="mb-0 fw-bolder fs-16 mb-1">Jumlah RW</p>
                                <p class="mb-0 fs-14">{{ $totalRW }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 
    <div class="card">
        <div class="card-body">
             <div class="table-responsive">
                <table id="dataTable" class="table data-table display nowrap table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>RT</th>
                            <th>RW</th>
                            <th>Kelurahan</th>
                            <th>Kecamatan</th>
                            <th>Ketua RT</th>
                            <th>Ketua RW</th>
                            <th>Jumlah</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel"><span id="txtTitle"></span> Data {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" class="fs-14 needs-validation" novalidate>
                    {{ method_field('POST') }}
                    <input type="text" class="d-none" id="id" name="id"/>
                    <div id="alert"></div>
                    <div class="row mb-2">
                        <label for="kecamatan_id" class="col-sm-3 col-form-label fw-bold">Kecamatan <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select select2" name="kecamatan_id" id="kecamatan_id">
                                <option value="">Pilih</option>
                                @foreach ($kecamatans as $i)
                                    <option value="{{ $i->id }}">{{ $i->n_kecamatan }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Silahkan pilih Kecamatan.
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="kelurahan_id" class="col-sm-3 col-form-label fw-bold">Kelurahan <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-select select2" name="kelurahan_id" id="kelurahan_id">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <label for="rt" class="col-sm-3 col-form-label fw-bold">RT / RW <span class="text-danger">*</span></label>
                        <div class="col-sm-4 mb-2">
                          <input type="text" maxlength="3" minlength="3" name="rt" id="rt" class="form-control" placeholder="RT / 001" autocomplete="off" required>
                        </div>
                        <div class="col-sm-5">
                            <input type="text" maxlength="3" name="rw" id="rw" class="form-control" placeholder="RW / 001" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="keterangan" class="col-sm-3 col-form-label fw-bold">Keterangan </label>
                        <div class="col-sm-9">
                            <textarea name="keterangan" id="keterangan" rows="2" class="form-control" placeholder="Nama Kampung / Cluster / Kawasan" autocomplete="off"></textarea>
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
            url: "{{ route('rt-rw.index') }}",
            method: 'GET',
            data: function (data) {
                data.kecamatan_filter = $('#kecamatan_filter').val();
                data.kelurahan_filter = $('#kelurahan_filter').val();
                data.rw_filter = $('#rw_filter').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'rt', name: 'rt', className: 'text-center'},
            {data: 'rw', name: 'rw', className: 'text-center'},
            {data: 'kelurahan_id', name: 'kelurahan_id'},
            {data: 'kecamatan_id', name: 'kecamatan_id'},
            {data: 'ketua_rt', name: 'ketua_rt', className: 'text-center'},
            {data: 'ketua_rw', name: 'ketua_rw', className: 'text-center'},
            {data: 'jumlah', name: 'jumlah', className: 'text-center'},
            {data: 'keterangan', name: 'keterangan'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });

    pressOnChange();
    function pressOnChange(){
        table.api().ajax.reload();
    }

    $('#kecamatan_id').on('change', function(){
        val = $(this).val();
        option = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#kelurahan_id').html(option);
        }else{
            $('#kelurahan_id').html("<option value=''>Loading...</option>");
            url = "{{ route('kelurahanByKecamatan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    console.log(data)
                    $.each(data, function(index, value){
                        option += "<option value='" + value.id + "'>" + value.n_kelurahan +"</li>";
                    });
                    $('#kelurahan_id').empty().html(option);

                    $("#kelurahan_id").val($("#kelurahan_id option:first").val());
                }else{
                    $('#kelurahan_id').html(option);
                }
            }, 'JSON'); 
        }
    });

    function openForm(){
        $('.select2').select2({
            dropdownParent: $('#modalForm')
        });
        $('#modalForm').modal('show');
    }

    $('#modalForm').on('hidden.bs.modal', function () {
        $('.select2').select2();
    });

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
        $.get("{{ Route('rt-rw.edit', ':id') }}".replace(':id', id), function(data){
            save_method = 'edit';
            $('#txtTitle').html('Edit');
            $('#txtSave').html("Perubahan");
            $('input[name=_method]').val('PATCH');
            $('#alert').html('');
            $('#loading').hide();
            openForm();
            $('#kecamatan_id').val(data.kecamatan_id).trigger("change.select2");

            val = data.kecamatan_id;
            url = "{{ route('kelurahanByKecamatan', ':id') }}".replace(':id', val);
            option = "<option value=''>&nbsp;</option>";
            $.get(url, function(dataResult){
                $.each(dataResult, function(index, value){
                    option += "<option value='" + value.id + "'>" + value.n_kelurahan +"</li>";
                });
                $('#kelurahan_id').empty().html(option);

                $("#kelurahan_id").val(data.kelurahan_id);
            }, 'JSON'); 

            $('#id').val(data.id);
            $('#rt').val(data.rt);
            $('#rw').val(data.rw);
            $('#keterangan').val(data.keterangan);
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
            
            url = (save_method == 'add') ? "{{ route('rt-rw.store') }}" : "{{ route('rt-rw.update', ':id') }}".replace(':id', $('#id').val());
            $.post(url, $(this).serialize(), function(data){
                $('#alert').html("<div class='alert alert-success alert-dismissible' role='alert'><strong>Sukses!</strong> " + data.message + "</div>");
                table.api().ajax.reload();
                if(save_method == 'add') $('#form').trigger('reset');
                $('#form').removeClass('was-validated');
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
                        $.post("{{ route('rt-rw.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
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