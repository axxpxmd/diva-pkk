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
        <select class="form-select select2" name="rw_filter" id="rw_filter" {{ isset($rw) ? 'disabled' : '-' }}>
            <option value="">Pilih</option>
        </select>
    </div>
</div>
@endif
@if (isset($rtDisplay) ? $rtDisplay == true : '')
<div class="row mb-2">
    <label for="rt_filter" class="col-form-label col-md-3 text-end fw-bolder fs-14">RT </label>
    <div class="col-sm-8">
        <select class="form-select select2" name="rt_filter" id="rt_filter" {{ isset($rw) ? 'disabled' : '-' }}>
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
    kelurahan = "{{ isset($kelurahan_id) ? $kelurahan_id : 0 }}"
    rtrw_id = "{{ isset($rtrw_id) ? $rtrw_id : 0 }}"
    rw = "{{ isset($rw) ? $rw : 0 }}"
    rt = "{{ isset($rt) ? $rt : 0 }}"

    console.log(kelurahan)
    console.log(rtrw_id)
    console.log(rt)
    console.log(rw)

    $(document).ready(function() {
        $('.select2').select2();
    });

    // kelurahan
    $(document).ready(function(){
        $("#kecamatan_filter").trigger('change');
    });
    $('#kecamatan_filter').on('change', function(){
        val = $(this).val();
        optionKelurahanFilter = "";
        if(val == ""){
            $('#kelurahan_filter').html(optionKelurahanFilter);
        }else{
            $('#kelurahan_filter').html("<option value=''>Loading...</option>");
            url = "{{ route('kelurahanByKecamatan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionKelurahanFilter += "<option value='" + value.id + "'>" + value.n_kelurahan +"</li>";
                    });
                    $('#kelurahan_filter').empty().html(optionKelurahanFilter);

                    if (kelurahan != 0) {
                        $("#kelurahan_filter").val(kelurahan);
                        $("#kelurahan_filter").trigger('change');
                    } else {
                        $("#kelurahan_filter").trigger('change');
                        $("#kelurahan_filter").val($("#kelurahan_filter option:first").val());
                    }
                }else{
                    $('#kelurahan_filter').html(optionKelurahanFilter);
                }
            }, 'JSON'); 
        }
    });

    // RW
    $('#kelurahan_filter').on('change', function(){
        val = $(this).val();
        optionRW = "";
        if(val == ""){
            $('#rw_filter').html(optionRW);
        }else{
            $('#rw_filter').html("<option value=''>Loading...</option>");
            url = "{{ route('rwByKelurahan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionRW += "<option value='" + value.rw + "'>" + 'RW ' + value.rw + "</li>";
                    });
                    $('#rw_filter').empty().html(optionRW);

                    if (rw != 0) {
                        $("#rw_filter").val(rw);
                        $("#rw_filter").trigger('change');
                    } else {
                        $("#rw_filter").trigger('change');
                        $("#rw_filter").val($("#rw_filter option:first").val());
                    }
                }else{
                    $('#rw_filter').html(optionRW);
                }
            }, 'JSON'); 
        }
    });

    // RT
    $('#rw_filter').on('change', function(){
        val = $(this).val();
        kecamatan_id = $("#kecamatan_filter").val();
        kelurahan_id = $("#kelurahan_filter").val();

        optionRT = "";
        if(val == ""){
            $('#rt_filter').html(optionRT);
        }else{
            $('#rt_filter').html("<option value=''>Loading...</option>");
            url = `{{ route('rtByRw', ':id') }}`.replace(':id', val);
            addParams = url  + '?kecamatan_id=' + kecamatan_id + '&kelurahan_id=' + kelurahan_id
            $.get(addParams, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionRT += "<option value='" + value.rt + "'>" + 'RT ' + value.rt + "</li>";
                    });

                    if (rt != 0) {
                        $("#rt_filter").val(rt);
                        $("#rt_filter").trigger('change');
                    } else {
                        optionRT +=  "<option value=''>Semua</option>";
                        $("#rt_filter").trigger('change');
                        $("#rt_filter").val($("#rt_filter option:first").val());
                    }

                    $('#rt_filter').empty().html(optionRT);
                }else{
                    $('#rt_filter').html(optionRT);
                }
            }, 'JSON'); 
        }
    });

    // RTRW
    $('#kelurahan_filter').on('change', function(){
        val = $(this).val();
        optionRTRW = "";
        if(val == ""){
            $('#rtrw_filter').html(optionRTRW);
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