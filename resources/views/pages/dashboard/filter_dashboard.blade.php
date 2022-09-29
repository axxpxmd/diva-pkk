<div class="modal fade" id="modalFilter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white" id="exampleModalLabel">Filter Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-2">
                    <label for="tahun" class="col-sm-3 col-form-label fw-bold">Tahun <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select select2" name="tahun" id="tahun">
                            <option value="">Pilih</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                        </select>
                        <div class="invalid-feedback">
                            Silahkan pilih Kecamatan.
                        </div>
                    </div>
                </div>
                <div class="row mb-2">
                    <label for="kecamatan_id" class="col-sm-3 col-form-label fw-bold">Kecamatan <span class="text-danger">*</span></label>
                    <div class="col-sm-9">
                        <select class="form-select select2" name="kecamatan_id" id="kecamatan_id">
                            <option value="">Pilih</option>
                            @foreach ($kecamatans as $i)
                            <option value="{{ $i->id }}">{{ $i->n_kecamatan }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Silahkan pilih Kecamatan.
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-9">
                        <button type="submit" class="btn btn-success fs-14"><i class="bi bi-filter m-r-8"></i>Filter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>