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
    <div class="card">  
        <div class="card-body">
            <div class="table-responsive">
                <table id="dataTable" class="table data-table table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nik</th>
                            <th>Dasawisma</th>
                            <th>No Telp</th>
                            <th>Alamat</th>
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
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span id="txtTitle"></span> Data {{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="form" class="fs-14 needs-validation">
                    {{ method_field('POST') }}
                    <input type="text" class="d-none" id="id" name="id"/>
                    <div id="alert"></div>
                    <div class="row mb-2">
                        <label for="username" class="col-sm-3 col-form-label">Username <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="username" id="username" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nama" class="col-sm-3 col-form-label">Nama <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="nik" class="col-sm-3 col-form-label">NIK <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="number" name="nik" id="nik" class="form-control" placeholder="16 Digit" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="no_telp" class="col-sm-3 col-form-label">No Telp <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="number" name="no_telp" id="no_telp" placeholder="08xxx" class="form-control" autocomplete="off" required>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="rtrw_id" class="col-sm-3 col-form-label">Alamat Kader <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select class="form-control select2" id="rtrw_id" name="rtrw_id"">
                                <option value="">Pilih</option>
                                @foreach ($rtrwAlls as $i)
                                    <option value="{{ $i->id }}">
                                        {{ $i->kecamatan->n_kecamatan }} - {{ $i->kelurahan->n_kelurahan }} - RT {{ $i->rw }} / RW {{ $i->rt }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-5">
                          <textarea type="number" name="alamat" id="alamat" cols="9" placeholder="Alamat Detail" class="form-control" autocomplete="off" required></textarea>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="alamat_dasawisma_id" class="col-sm-3 col-form-label">Dasawisma <span class="text-danger">*</span></label>
                        <div class="col-sm-4">
                            <select class="form-control select2" id="alamat_dasawisma_id" name="alamat_dasawisma_id"">
                                <option value="">Pilih</option>
                                @foreach ($rtrwKelurahans as $i)
                                    <option value="{{ $i->id }}">
                                        {{ $i->kecamatan->n_kecamatan }} - {{ $i->kelurahan->n_kelurahan }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-5">
                            <select class="form-control select2" name="dasawisma_id" id="dasawisma_id">
                                <option value="">Pilih</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label for="role_id" class="col-sm-3 col-form-label">Role <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                            <select class="form-control select2" name="role_id" id="role_id">
                                <option value="">Pilih</option>
                                @foreach ($roles as $i)
                                    <option value="{{ $i->id }}">{{ $i->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3"></div>
                        <div class="col-9">
                            <button type="submit" class="btn btn-primary fs-14" id="btnSave" title="Simpan Data"><i class="bi bi-save m-r-8"></i>Simpan <span id="txtSave"></span></button>
                            <a href="#" onclick="add()" class="m-l-5 text-danger fs-14" title="Kosongkan Form"><i class="bi bi-arrow-clockwise m-r-8"></i>Reset</a>
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
            url: "{{ route('kader.index') }}",
            method: 'GET'
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'nama', name: 'nama'},
            {data: 'nik', name: 'nik'},
            {data: 'dasawisma_id', name: 'dasawisma_id'},
            {data: 'no_telp', name: 'no_telp'},
            {data: 'alamat', name: 'alamat'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });

    $('.select2').select2({
        dropdownParent: $('#modalForm')
    });

    $('#alamat_dasawisma_id').on('change', function(){
        val = $(this).val();
        option = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#dasawisma_id').html(option);
        }else{
            $('#dasawisma_id').html("<option value=''>Loading...</option>");
            url = "{{ route('dasawismaByRTRW', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        option += "<option value='" + value.id + "'>" + value.nama +"</li>";
                    });
                    $('#dasawisma_id').empty().html(option);

                    $("#dasawisma_id").val($("#dasawisma_id option:first").val()).trigger("change.select2");
                }else{
                    $('#dasawisma_id').html(option);
                }
            }, 'JSON'); 
        }
    });

    function openForm(){
        $('#modalForm').modal('show');
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
        $.get("{{ Route('kader.edit', ':id') }}".replace(':id', id), function(data){
            save_method = 'edit';
            $('#txtTitle').html('Edit');
            $('#txtSave').html("Perubahan");
            $('input[name=_method]').val('PATCH');
            $('#alert').html('');
            $('#loading').hide();
            openForm();
            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#username').val(data.username);
            $('#nik').val(data.nik);
            $('#no_telp').val(data.no_telp);
            $('#alamat').val(data.alamat);
            $('#rtrw_id').val(data.rtrw_id).trigger("change.select2");
            $('#role_id').val(data.role_id).trigger("change.select2");

            $('#alamat_dasawisma_id').val(data.alamat_dasawisma_id).trigger("change.select2");

            val = data.alamat_dasawisma_id;
            url = "{{ route('dasawismaByRTRW', ':id') }}".replace(':id', val);
            option = "<option value=''>&nbsp;</option>";
            $.get(url, function(dataResult){
                if(dataResult){
                    $.each(dataResult, function(index, value){
                        option += "<option value='" + value.id + "'>" + value.nama +"</li>";
                    });
                    $('#dasawisma_id').empty().html(option);

                    $("#dasawisma_id").val(data.dasawisma_id).trigger("change.select2");
                }else{
                    $('#dasawisma_id').html(option);
                }
            }, 'JSON'); 
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
            
            url = (save_method == 'add') ? "{{ route('kader.store') }}" : "{{ route('kader.update', ':id') }}".replace(':id', $('#id').val());
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
                        $.post("{{ route('kader.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
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