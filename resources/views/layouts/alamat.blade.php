<div class="row mb-2">
    <label for="kecamatan_id" class="col-sm-3 col-form-label fw-bold">Kecamatan <span class="text-danger">*</span></label>
    <div class="col-sm-9">
        <select class="form-select select2" id="kecamatan_id">
            <option value="">Pilih</option>
            @foreach ($kecamatans as $i)
                <option value="{{ $i->id }}">{{ $i->n_kecamatan }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-2">
    <label for="kelurahan_id" class="col-sm-3 col-form-label fw-bold">Kelurahan <span class="text-danger">*</span></label>
    <div class="col-sm-9">
        <select class="form-select select2" id="kelurahan_id">
            <option value="">Pilih</option>
        </select>
    </div>
</div>
<div class="row mb-2">
    <label for="rtrw_id" class="col-sm-3 col-form-label fw-bold">RT / RW <span class="text-danger">*</span></label>
    <div class="col-sm-9">
        <select class="form-select select2" name="rtrw_id" id="rtrw_id">
            <option value="">Pilih</option>
        </select>
    </div>
</div>
@push('script')
<script type="text/javascript">
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

    $('#kelurahan_id').on('change', function(){
        val = $(this).val();
        option = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#rtrw_id').html(option);
        }else{
            $('#rtrw_id').html("<option value=''>Loading...</option>");
            url = "{{ route('rtrwByKelurahan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        option += "<option value='" + value.id + "'>" + 'RW ' + value.rw + ' / RT ' + value.rt + "</li>";
                    });
                    $('#rtrw_id').empty().html(option);

                    $("#rtrw_id").val($("#rtrw_id option:first").val());
                }else{
                    $('#rtrw_id').html(option);
                }
            }, 'JSON'); 
        }
    });

</script>
@endpush