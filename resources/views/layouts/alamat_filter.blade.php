@if (isset($kecamatanDisplay))
<div class="row mb-2">
    <label for="kecamatan_filter" class="col-form-label col-md-2 text-end fw-bolder fs-14">Kecamatan </label>
    <div class="col-sm-8">
        <select class="form-select select2" id="kecamatan_filter" name="kecamatan_filter">
            @foreach ($kecamatans as $i)
                <option value="{{ $i->id }}">{{ $i->n_kecamatan }}</option>
            @endforeach
        </select>
    </div>
</div>
@endif
@if (isset($kelurahanDisplay))
<div class="row mb-2">
    <label for="kelurahan_filter" class="col-form-label col-md-2 text-end fw-bolder fs-14">Kelurahan </label>
    <div class="col-sm-8">
        <select class="form-select select2" name="kelurahan_filter" id="kelurahan_filter">
            <option value="">Pilih</option>
        </select>
    </div>
</div>
@endif
@if (isset($rwDisplay))
<div class="row mb-2">
    <label for="RW" class="col-form-label col-md-2 text-end fw-bolder fs-14">RW </label>
    <div class="col-sm-8">
        <input type="number" name="rw_filter" id="rw_filter" class="form-control" placeholder="Masukan No RW" autocomplete="off">
    </div>
</div>
@endif
@if (isset($rtrwDisplay))
<div class="row mb-2">
    <label for="rtrw_filter" class="col-form-label col-md-2 text-end fw-bolder fs-14">RT / RW <span class="text-danger">*</span></label>
    <div class="col-sm-9">
        <select class="form-select select2" name="rtrw_filter" id="rtrw_filter">
            <option value="">Pilih</option>
        </select>
    </div>
</div>
@endif
@push('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('.select2').select2();
    });

    $('#kecamatan_filter').on('change', function(){
        val = $(this).val();
        option = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#kelurahan_filter').html(option);
        }else{
            $('#kelurahan_filter').html("<option value=''>Loading...</option>");
            url = "{{ route('kelurahanByKecamatan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        option += "<option value='" + value.id + "'>" + value.n_kelurahan +"</li>";
                    });
                    $('#kelurahan_filter').empty().html(option);

                    $("#kelurahan_filter").val($("#kelurahan_filter option:first").val());
                }else{
                    $('#kelurahan_filter').html(option);
                }
            }, 'JSON'); 
        }
    });

    $('#kelurahan_filter').on('change', function(){
        val = $(this).val();
        option = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#rtrw_filter').html(option);
        }else{
            $('#rtrw_filter').html("<option value=''>Loading...</option>");
            url = "{{ route('rtrwByKelurahan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        option += "<option value='" + value.id + "'>" + 'RW ' + value.rw + ' / RT ' + value.rt + "</li>";
                    });
                    $('#rtrw_filter').empty().html(option);

                    $("#rtrw_filter").val($("#rtrw_filter option:first").val());
                }else{
                    $('#rtrw_filter').html(option);
                }
            }, 'JSON'); 
        }
    });

</script>
@endpush