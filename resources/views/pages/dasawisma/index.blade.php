@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    @if ($role_id != 2)
    <div class="mb-3 text-right">
        <a href="#" onclick="add()" class="btn btn-sm btn-success px-2"><i class="bi bi-plus font-weight-bold fs-16 m-r-5"></i>Tambah Data</a>
    </div>
    @endif
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
                                <p class="mb-0 fw-bolder fs-16 mb-1">Jumlah Dasawisma</p>
                                <p class="mb-0 fs-14"></p>
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
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Jumlah Ketua</th>
                            <th>Jumlah</th>
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
                    <div id="alert"></div>
                    @include('layouts.alamat')
                    <div class="row mb-2">
                        <label for="nama" class="col-sm-3 col-form-label fw-bold">Nama <span class="text-danger">*</span></label>
                        <div class="col-sm-9">
                          <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" required>
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
<div class="modal fade" id="modalShowKetua" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">List Ketua Dasawisma <span id="dasawismaKetua"></span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table data-table display nowrap table-hover table-bordered" style="width:100%;">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th>Nama</th>
                            <th>No Telp</th>
                        </tr>
                    </thead>
                    <tbody id="tableKetua"></tbody>
                </table>
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
            url: "{{ route('dasawisma.index') }}",
            method: 'GET',
            data: function (data) {
                data.kecamatan_filter = $('#kecamatan_filter').val();
                data.kelurahan_filter = $('#kelurahan_filter').val();
                data.rw_filter = $('#rw_filter').val();
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', className: 'text-center', orderable: false, searchable: false},
            {data: 'nama', name: 'nama'},
            {data: 'alamat', name: 'alamat'},
            {data: 'ketua_id', name: 'ketua_id', className: 'text-center'},
            {data: 'jumlah', name: 'jumlah', className: 'text-center'},
            {data: 'action', name: 'action', className: 'text-center', orderable: false, searchable: false}
        ]
    });

    pressOnChange();
    function pressOnChange(){
        table.api().ajax.reload();
    }

    function openForm(){
        $('.select2').select2({
            dropdownParent: $('#modalForm')
        });
        $('#modalForm').modal('show');
    }

    $('#modalForm').on('hidden.bs.modal', function () {
        $('.select2').select2();
    });

    function showKetua(id){
        $('#loading').show();
        $('#modalShowKetua').modal('show');
        $('#tableKetua').html('')
        $.get("{{ Route('dasawisma.showKetua', ':id') }}".replace(':id', id), function(data){
            $('#loading').hide();
            $('#dasawismaKetua').html(data[0].dasawisma);
            $.each(data, function(index, value){
                $('#tableKetua').append("<tr>\
                                            <td class='text-center'>"+(index+1)+"</td>\
                                            <td>"+value.ketua+"</td>\
                                            <td>"+value.no_telp+"</td>\
										</tr>"
                );
            });
        });
    }

    function add(){
        openForm();
        save_method = "add";
        $('#form').trigger('reset');
        $('input[name=_method]').val('POST');
        $('#txtTitle').html('Tambah');
        $('#txtSave').html('');
        $('#alert').html('');
        $('#kecamatan_id').attr('disabled', false)
        $('#kelurahan_id').attr('disabled', false)
        $('#rtrw_id').attr('disabled', false)
    }

    function edit(id){
        $('#loading').show();
        $('#kecamatan_id').attr('disabled', true)
        $('#kelurahan_id').attr('disabled', true)
        $('#rtrw_id').attr('disabled', true)
        $.get("{{ Route('dasawisma.edit', ':id') }}".replace(':id', id), function(data){
            console.log(data)
            save_method = 'edit';
            $('#txtTitle').html('Edit');
            $('#txtSave').html("Perubahan");
            $('input[name=_method]').val('PATCH');
            $('#alert').html('');
            $('#loading').hide();
            openForm();
            $('#id').val(data.id);
            $('#nama').val(data.nama);
            $('#kecamatan_id').val(data.kecamatan_id).trigger("change.select2");

            rtrw_id      = data.rtrw_id;
            dasawisma_id = data.dasawisma_id;
            kecamatan_id = data.kecamatan_id
            kelurahan_id = data.kelurahan_id

            // get kelurahan
            url = "{{ route('kelurahanByKecamatan', ':id') }}".replace(':id', kecamatan_id);
            optionKelurahan = "<option value=''>&nbsp;</option>";
            $.get(url, function(dataKelurahan){
                if(dataKelurahan){
                    $.each(dataKelurahan, function(index, value){
                        optionKelurahan += "<option value='" + value.id + "'>" + value.n_kelurahan +"</li>";
                    });
                    $('#kelurahan_id').empty().html(optionKelurahan);

                    $("#kelurahan_id").val(data.kelurahan_id).trigger("change.select2");
                }else{
                    $('#kelurahan_id').html(optionKelurahan);
                } 
            }, 'JSON'); 

            // get rtrw
            url = "{{ route('rtrwByKelurahan', ':id') }}".replace(':id', kelurahan_id);
            optionRTRW = "<option value=''>&nbsp;</option>";
            $.get(url, function(dataRTRW){
                if(dataRTRW){
                    $.each(dataRTRW, function(index, value){
                        optionRTRW += "<option value='" + value.id + "'>" + 'RW ' + value.rw + ' / RT ' + value.rt + "</li>";
                    });
                    $('#rtrw_id').empty().html(optionRTRW);

                    $("#rtrw_id").val(rtrw_id). trigger("change.select2");
                }else{
                    $('#rtrw_id').html(optionRTRW);
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
            
            url = (save_method == 'add') ? "{{ route('dasawisma.store') }}" : "{{ route('dasawisma.update', ':id') }}".replace(':id', $('#id').val());
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
                        $.post("{{ route('dasawisma.destroy', ':id') }}".replace(':id', id), {'_method' : 'DELETE'}, function(data) {
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