@if (isset($kecamatanDisplay) ? $kecamatanDisplay == true : '')
<div class="row mb-2">
    <label for="kecamatan_filter" class="col-form-label col-md-3 text-end fw-bolder fs-14">Kecamatan </label>
    <div class="col-sm-8">
        <select class="form-select select2" id="kecamatan_filter" name="kecamatan_filter" {{ isset($kecamatan_id) ? 'disabled' : '-' }}>
            @foreach ($kecamatans as $i)
                <option value="{{ $i->id }}" {{ isset($kecamatan_id) ? $kecamatan_id == $i->id ? 'selected' : '-' : '-' }}>{{ $i->n_kecamatan }}</option>
            @endforeach
        </select>
    </div>
</div>
@endif
@if (isset($kelurahanDisplay) ? $kelurahanDisplay == true : '')
<div class="row mb-2">
    <label for="kelurahan_filter" class="col-form-label col-md-3 text-end fw-bolder fs-14">Kelurahan </label>
    <div class="col-sm-8">
        <select class="form-select select2" name="kelurahan_filter" id="kelurahan_filter" {{ isset($kelurahan_id) ? 'disabled' : '-' }}>
            <option value="">Pilih</option>
        </select>
    </div>
</div>
@endif
@if (isset($rwDisplay) ? $rwDisplay == true : '')
<div class="row mb-2">
    <label for="rw_filter" class="col-form-label col-md-3 text-end fw-bolder fs-14">RW </label>
    <div class="col-sm-8">
        <select class="form-select select2" name="rw_filter" id="rw_filter">
            <option value="">Pilih</option>
        </select>
    </div>
</div>
@endif
@if (isset($rtrwDisplay) ? $rtrwDisplay == true : '')
<div class="row mb-2">
    <label for="rtrw_filter" class="col-form-label col-md-3 text-end fw-bolder fs-14">RT / RW </label>
    <div class="col-sm-8">
        <select class="form-select select2" name="rtrw_filter" id="rtrw_filter" {{ isset($rtrw_id) ? 'disabled' : '-' }}>
            <option value="">Pilih</option>
        </select>
    </div>
</div>
@endif
@push('script')
<script type="text/javascript">
    kelurahan_id = "{{ isset($kelurahan_id) ? $kelurahan_id : 0 }}"
    rtrw_id = "{{ isset($rtrw_id) ? $rtrw_id : 0 }}"

    $(document).ready(function() {
        $('.select2').select2();
    });

    // kelurahan
    $(document).ready(function(){
        $("#kecamatan_filter").trigger('change');
    });
    $('#kecamatan_filter').on('change', function(){
        val = $(this).val();
        optionKelurahan = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#kelurahan_filter').html(option);
        }else{
            $('#kelurahan_filter').html("<option value=''>Loading...</option>");
            url = "{{ route('kelurahanByKecamatan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionKelurahan += "<option value='" + value.id + "'>" + value.n_kelurahan +"</li>";
                    });
                    $('#kelurahan_filter').empty().html(optionKelurahan);

                    if (kelurahan_id) {
                        $("#kelurahan_filter").val(kelurahan_id);
                        $("#kelurahan_filter").trigger('change');
                    } else {
                        $("#kelurahan_filter").val($("#kelurahan_filter option:first").val());
                    }

                }else{
                    $('#kelurahan_filter').html(optionKelurahan);
                }
            }, 'JSON'); 
        }
    });

    // RW
    $('#kelurahan_filter').on('change', function(){
        val = $(this).val();
        optionRW = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#rw_filter').html(option);
        }else{
            $('#rw_filter').html("<option value=''>Loading...</option>");
            url = "{{ route('rwByKelurahan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionRW += "<option value='" + value.rw + "'>" + 'RW ' + value.rw + "</li>";
                    });
                    $('#rw_filter').empty().html(optionRW);

                    $("#rw_filter").val($("#rw_filter option:first").val());
                }else{
                    $('#rw_filter').html(optionRW);
                }
            }, 'JSON'); 
        }
    });

    $('#kelurahan_filter').on('change', function(){
        val = $(this).val();
        optionRTRW = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#rtrw_filter').html(option);
        }else{
            $('#rtrw_filter').html("<option value=''>Loading...</option>");
            url = "{{ route('rtrwByKelurahan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionRTRW += "<option value='" + value.id + "'>" + 'RW ' + value.rw + ' / RT ' + value.rt + "</li>";
                    });
                    $('#rtrw_filter').empty().html(optionRTRW);

                    if (rtrw_id) {
                        $("#rtrw_filter").val(rtrw_id);   
                        $("#rtrw_filter").trigger('change');
                    } else {
                        $("#rtrw_filter").val($("#rtrw_filter option:first").val());
                    }

                }else{
                    $('#rtrw_filter').html(optionRTRW);
                }
            }, 'JSON'); 
        }
    });

</script>
@endpush