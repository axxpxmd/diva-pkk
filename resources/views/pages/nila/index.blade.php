@extends('pages.nila.app')
@section('content')
<div class="container col-md-6 ">
    <div class="card my-3">
        <div class="card-body">
            <form action="">
                <div class="row mb-2">
                    <label for="n_dinas" class="col-sm-3 col-form-label fw-bold">Nama Dinas <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" name="n_dinas" id="n_dinas" placeholder="Nama Dinas" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="no_surat" class="col-sm-3 col-form-label fw-bold">Nomor Surat <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" name="no_surat" id="no_surat" placeholder="Nomor Surat" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="nama" class="col-sm-3 col-form-label fw-bold">Nama <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="text" name="nama" id="nama" placeholder="Nama Kepala Dinas" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="nip" class="col-sm-3 col-form-label fw-bold">NIP <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                      <input type="number" name="nip" id="nip" placeholder="NIP Kepala Dinas" class="form-control" autocomplete="off" required>
                    </div>
                </div>
                <div class="row mb-2">
                    <label class="col-sm-3"></label>
                    <div class="col-sm-9">
                        <a href="#" target="_blank" id="generateSurat" onclick="getParams()" class="btn btn-sm btn-primary">Generate Surat</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('script')
<script type="text/javascript">
    function getParams(){
       
        // params
        n_dinas = $('#n_dinas').val();
        no_surat = $('#no_surat').val();
        nama = $('#nama').val();
        nip = $('#nip').val();

        url = "{{ route('tandaTanganGenerateSurat') }}?n_dinas=" + n_dinas + "&no_surat=" + no_surat + "&nama=" + nama + "&nip=" + nip;
        
        $('#generateSurat').attr('href', url)
    }
</script>
@endpush