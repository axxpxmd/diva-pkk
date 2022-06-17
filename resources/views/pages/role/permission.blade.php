@extends('layouts.app')
@section('content')
<div class="page-heading mb-0">
    <h3>{{ $title }}</h3>
    <p class="text-subtitle text-muted">{{ $desc }}</p>
</div>
<section class="section animate__animated animate__fadeInRight">
    <div class="card">
        <h5 class="card-header px-4 py-3 bg-info text-white">Tambah Permission</h5>
        <div class="card-body mt-4">
            <div class="row">
                <div class="col-sm-6">
                    <div id="alert"></div>
                    <form class="needs-validation" id="form" method="POST" novalidate>
                        {{ method_field('POST') }}
                        <input type="hidden" id="id" name="id" value="{{ $role->id }}"/>
                        <div class="row mb-2">
                            <label for="permissions" class="col-sm-3 col-form-label">Permission :</label>
                            <div class="col-sm-9">
                                <select class="select2 form-select" name="permissions[]" id="permissions" multiple="multiple" required>
                                    @foreach($permissions as $key=>$permission)
                                        <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3"></div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-primary fs-14" id="action"><i class="bi bi-save m-r-8"></i>Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-sm-1">&nbsp;</div>
                <div class="col-sm-5">
                    <strong>List Permission:</strong>
                    <ol id="viewPermission" class=""></ol>
                </div>
            </div>  
        </div>
    </div>
</section>
@endsection
@push('script')
<script type="text/javascript">  
    getPermissions(); 
    function getPermissions(){
        $('#viewPermission').html("Loading...");
        urlPermission = "{{ route('role.getPermission', ':id') }}".replace(':id', $('#id').val());
        $.get(urlPermission, function(data){
            $('#viewPermission').html("");
            if(data.length > 0){
                $.each(data, function(index, value){
                    val = "'" + value.name + "'";
                    $('#viewPermission').append('<li>' + value.name + ' <a href="#" onclick="removePermission(' + val + ')" class="text-danger" title="Hapus Data"><i class="bi bi-x"></i></a></li>');
                });
            }else{
                $('#viewPermission').html("<em>Data permission kosong.</em>");
            }
        });
    }

    $('#form').on('submit', function (e) {
        if ($(this)[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
        }
        else{
            $('#alert').html('');
            $('#action').attr('disabled', true);
            $.post("{{ route('role.storePermission') }}", $(this).serialize(), function(data){
                $('#alert').html("<div class='alert alert-success alert-dismissible' role='alert'><strong>Sukses!</strong> " + data.message + "</div>");
                getPermissions();
                location.reload();
            }, "JSON").fail(function(data){
                err = ''; respon = data.responseJSON;
                $.each(respon.errors, function( index, value ) {
                    err += "<li>" + value +"</li>";
                });
            }).always(function(){
                $('#action').removeAttr('disabled');
            });
            return false;
        }
        $(this).addClass('was-validated');
    });

    function removePermission(name){
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
                        $.post("{{ route('role.destroyPermission', ':name') }}".replace(':name', name), {'_method' : 'DELETE', 'id' : $('#id').val()}, function(data){
                            getPermissions();
                            location.reload();
                        }, "JSON").fail(function(){
                            reload();
                        });
                    }
                },
                cancel: function(){
                    console.log('the user clicked cancel');
                }
            }
        });
    }
</script>
@endpush