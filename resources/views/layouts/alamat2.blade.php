<div class="row mb-2">
    <label for="kecamatan_id" class="col-sm-4 col-form-label fw-bold text-end">Kecamatan <span class="text-danger">*</span></label>
    <div class="col-sm-8">
        <select class="form-select select2" name="kecamatan_id" id="kecamatan_id">
            <option value="">Pilih</option>
            @foreach ($kecamatans as $i)
                <option value="{{ $i->id }}" {{ isset($kecamatan_id) ? $i->id == $kecamatan_id ? 'selected' : '-' : '' }}>{{ $i->n_kecamatan }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row mb-2">
    <label for="kelurahan_id" class="col-sm-4 col-form-label fw-bold text-end">Kelurahan <span class="text-danger">*</span></label>
    <div class="col-sm-8">
        <select class="form-select select2" name="kelurahan_id" id="kelurahan_id">
            <option value="">Pilih</option>
        </select>
    </div>
</div>
<div class="row mb-2">
    <label for="rtrw_id" class="col-sm-4 col-form-label fw-bold text-end">RT / RW <span class="text-danger">*</span></label>
    <div class="col-sm-8">
        <select class="form-select select2" name="rtrw_id" id="rtrw_id">
            <option value="">Pilih</option>
        </select>
    </div>
</div>
@push('script')
<script type="text/javascript">
    kelurahan_id = "{{ isset($kelurahan_id) ? $kelurahan_id : 0 }}"
    rtrw_id = "{{ isset($rtrw_id) ? $rtrw_id : 0 }}"

    $(document).ready(function(){
        $("#kecamatan_id").trigger('change');
    })
    $('#kecamatan_id').on('change', function(){
        $('#kelurahan_id').val("").trigger("change.select2");
        $('#rtrw_id').val("").trigger("change.select2");
        $('#dasawisma_id').val("").trigger("change.select2");
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

                    if (kelurahan_id) {
                        $("#kelurahan_id").val(kelurahan_id);
                        $("#kelurahan_id").trigger('change');
                    } else {
                        $("#kelurahan_id").val($("#kelurahan_id option:first").val());
                    }
                   
                }else{
                    $('#kelurahan_id').html(option);
                }
            }, 'JSON'); 
        }
    });

    $('#kelurahan_id').on('change', function(){
        $('#rtrw_id').val("").trigger("change.select2");
        $('#dasawisma_id').val("").trigger("change.select2");
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

                    if (rtrw_id) {
                        $("#rtrw_id").val(rtrw_id);   
                        $("#rtrw_id").trigger('change');
                    } else {
                        $("#rtrw_id").val($("#rtrw_id option:first").val());
                    }
                }else{
                    $('#rtrw_id').html(option);
                }
            }, 'JSON'); 
        }
    });

</script>
@endpush