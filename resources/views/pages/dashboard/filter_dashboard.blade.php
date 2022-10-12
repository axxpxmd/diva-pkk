<div class="modal fade" id="modalFilter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <label for="tahun" class="col-sm-3 col-form-label fw-bold">Tahun</label>
                    <div class="col-sm-9">
                        <select class="form-select select2" name="tahun" id="tahun">
                            <option value="">Pilih</option>
                            <option value="2021" {{ $tahun == 2021 ? 'selected' : '' }}>2021</option>
                            <option value="2022" {{ $tahun == 2022 ? 'selected' : '' }}>2022</option>
                            <option value="2023" {{ $tahun == 2023 ? 'selected' : '' }}>2023</option>
                            <option value="2024" {{ $tahun == 2024 ? 'selected' : '' }}>2024</option>
                        </select>
                        <div class="invalid-feedback">
                            Silahkan pilih Kecamatan.
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="kecamatan_id" class="col-sm-3 col-form-label fw-bold">Kecamatan</label>
                    <div class="col-sm-9">
                        <select class="form-select select2" name="kecamatan_id" id="kecamatan_id">
                            <option value="">Pilih</option>
                            @foreach ($kecamatans as $i)
                            <option value="{{ $i->id }}" {{ $kecamatan_id == $i->id ? 'selected' : '' }}>{{ $i->n_kecamatan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="kelurahan_id" class="col-sm-3 col-form-label fw-bold">Kelurahan</label>
                    <div class="col-sm-9">
                        <select class="form-select select2" name="kelurahan_id" id="kelurahan_id">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="rtrw_id" class="col-sm-3 col-form-label fw-bold">RT / RW</label>
                    <div class="col-sm-9">
                        <select class="form-select select2" name="rtrw_id" id="rtrw_id">
                            <option value="">Pilih</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <a href="#" id="filterData" class="btn btn-success fs-14"><i class="bi bi-filter m-r-8"></i>Filter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    // Tahun
    $('#tahun').on('change', function(){
        getParamFilter()
    });

    // RTRW
    $('#rtrw_id').on('change', function(){
        getParamFilter()
    });

    kelurahan_id = "{{ isset($kelurahan_id) ? $kelurahan_id : 0 }}"
    rtrw_id = "{{ isset($rtrw_id) ? $rtrw_id : 0 }}"

    $(document).ready(function(){
        $("#kecamatan_id").trigger('change');
    })
    $('#kecamatan_id').on('change', function(){
        $('#kelurahan_id').val("").trigger("change.select2");
        $('#rtrw_id').val("").trigger("change.select2");
        val = $(this).val();
        optionKelurahan = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#kelurahan_id').html(optionKelurahan);
        }else{
            $('#kelurahan_id').html("<option value=''>Loading...</option>");
            url = "{{ route('kelurahanByKecamatan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionKelurahan += "<option value='" + value.id + "'>" + value.n_kelurahan +"</li>";
                    });
                    $('#kelurahan_id').empty().html(optionKelurahan);

                    if (kelurahan_id) {
                        $("#kelurahan_id").val(kelurahan_id);
                        $("#kelurahan_id").trigger('change');
                    } else {
                        $("#kelurahan_id").val($("#kelurahan_id option:first").val());
                    }
                    getParamFilter()
                   
                }else{
                    $('#kelurahan_id').html(optionKelurahan);
                }
            }, 'JSON'); 
        }
    });

    $('#kelurahan_id').on('change', function(){
        $('#rtrw_id').val("").trigger("change.select2");
        val = $(this).val();
        optionRTRW = "<option value=''>Pilih</option>";
        if(val == ""){
            $('#rtrw_id').html(optionRTRW);
        }else{
            $('#rtrw_id').html("<option value=''>Loading...</option>");
            url = "{{ route('rtrwByKelurahan', ':id') }}".replace(':id', val);
            $.get(url, function(data){
                if(data){
                    $.each(data, function(index, value){
                        optionRTRW += "<option value='" + value.id + "'>" + 'RW ' + value.rw + ' / RT ' + value.rt + "</li>";
                    });
                    $('#rtrw_id').empty().html(optionRTRW);

                    if (rtrw_id) {
                        $("#rtrw_id").val(rtrw_id);   
                        $("#rtrw_id").trigger('change');
                    } else {
                        $("#rtrw_id").val($("#rtrw_id option:first").val());
                    }
                }else{
                    $('#rtrw_id').html(optionRTRW);
                }
            }, 'JSON'); 
        }
        getParamFilter()
    });


    function getParamFilter()
    {
        tahun =  $("#tahun").val(); 
        kecamatan_id = $("#kecamatan_id").val();
        kelurahan_id = $("#kelurahan_id").val();
        rtrw_id = $("#rtrw_id").val();

        url = "{{ route('dashboard') }}?tahun=" + tahun + "&kecamatan_id=" + kecamatan_id + "&kelurahan_id=" + kelurahan_id + "&rtrw_id=" + rtrw_id;

        $('#filterData').attr('href', url);
    }

</script>
@endpush