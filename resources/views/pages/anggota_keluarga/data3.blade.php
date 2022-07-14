<div class="row mt-2">
    <div class="col-sm-6">
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Program Bina Balita <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="prgrm_bina_balita" id="prgrm_bina_balita" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="prgrm_bina_balita" id="prgrm_bina_balita" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Memiliki Tabungan <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="tabungan" id="tabungan" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="tabungan" id="tabungan" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Kelompok Belajar <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="0" name="klmpk_belajar" id="klmpk_belajar" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="1" name="klmpk_belajar" id="klmpk_belajar" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
            <div class="col-sm-4 m-t-6" id="jns_klmpk_belajar_display" style="display: none">
                <select class="select2 form-select add-required-form3" id="jns_klmpk_belajar" name="jns_klmpk_belajar">
                    <option value="">Pilih</option>
                    <option value="Paket A">Paket A</option>
                    <option value="Paket B">Paket B</option>
                    <option value="Paket C">Paket C</option>
                    <option value="KF">KF</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih jenis kelompok belajar.
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">PAUD / Sejenis <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="paud" id="paud" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="paud" id="paud" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Kegiatan Koperasi <span class="text-danger">*</span></label>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="0" name="kgtn_koperasi" id="kgtn_koperasi" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-2 m-t-6">
                <input type="radio" value="1" name="kgtn_koperasi" id="kgtn_koperasi" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
            <div class="col-sm-4 m-t-6" id="jns_kgtn_koperasi_display" style="display: none">
                <input type="text" name="jns_kgtn_koperasi" id="jns_kgtn_koperasi" class="form-control add-required-form3" placeholder="Jenis Koperasi" autocomplete="off">
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Kegiatan Pancasila <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="kgtn_pancasila" id="kgtn_pancasila" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="kgtn_pancasila" id="kgtn_pancasila" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
        <div class="row mb-2 mt-2" style="display: none" id="jns_kgtn_pancasila_display">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <select class="select2 form-select add-required-form3" id="jns_kgtn_pancasila" name="jns_kgtn_pancasila[]" multiple="multiple">
                    <option value="">Pilih</option>
                    <option value="Kegiatan Keagamaan">Kegiatan Keagamaan</option>
                    <option value="PKBN">PKBN</option>
                    <option value="Pola Asuh">Pola Asuh</option>
                    <option value="Pencegahan KDRT">Pencegahan KDRT</option>
                    <option value="Pencegahan Trafficking">Pencegahan Trafficking</option>
                    <option value="Pencegahan Kejahatan Seksual">Pencegahan Kejahatan Seksual</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih Jenis Kegiatan Pancasila.
                </div>
                <input type="text" name="jns_kgtn_keagamaan" id="jns_kgtn_keagamaan" placeholder="Jenis Kegiatan Keagamaan" class="form-control add-required-form3 mt-2" style="display: none;">
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Gotong Royong <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="gotong_royong" id="gotong_royong" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="gotong_royong" id="gotong_royong" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
        <div class="row mt-2" style="display: none" id="jns_gotong_royong_display">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <select class="select2 form-select add-required-form3" id="jns_gotong_royong" name="jns_gotong_royong[]" multiple="multiple">
                    <option value="">Pilih</option>
                    <option value="Kerja Bakti">Kerja Bakti</option>
                    <option value="Jimpitan">Jimpitan</option>
                    <option value="Arisan">Arisan</option>
                    <option value="Rukun Kematian">Rukun Kematian</option>
                    <option value="Bakti Sosial">Bakti Sosial</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
                <div class="invalid-feedback">
                    Silahkan pilih Jenis Gotong Royong.
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <label class="col-sm-4 col-form-label text-end fw-bold">Hatinya PKK <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="hatinya_pkk" id="hatinya_pkk" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="hatinya_pkk" id="hatinya_pkk" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
        <div id="jns_hatinya_pkk_display" style="display: none">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_hatinya_pkk[]" id="peternakan" onchange="hatinyaPKK('peternakan')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Peternakan
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="peternakan_komoditi_display" style="display: none">
                    <input type="text" name="peternakan_komoditi" onkeyup="valueToHatinyaPKK('peternakan')" id="peternakan_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="peternakan_kuantitas_display" style="display: none">
                    <input type="number" name="peternakan_kuantitas" onkeyup="valueToHatinyaPKK('peternakan')" id="peternakan_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_hatinya_pkk[]" id="perikanan" onchange="hatinyaPKK('perikanan')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Perikanan
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="perikanan_komoditi_display" style="display: none">
                    <input type="text" name="perikanan_komoditi" onkeyup="valueToHatinyaPKK('perikanan')" id="perikanan_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="perikanan_kuantitas_display" style="display: none">
                    <input type="number" name="perikanan_kuantitas" onkeyup="valueToHatinyaPKK('perikanan')" id="perikanan_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_hatinya_pkk[]" id="warung_hidup" onchange="hatinyaPKK('warung_hidup')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Warung Hidup
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="warung_hidup_komoditi_display" style="display: none">
                    <input type="text" name="warung_hidup_komoditi" onkeyup="valueToHatinyaPKK('warung_hidup')" id="warung_hidup_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="warung_hidup_kuantitas_display" style="display: none">
                    <input type="number" name="warung_hidup_kuantitas" onkeyup="valueToHatinyaPKK('warung_hidup')" id="warung_hidup_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_hatinya_pkk[]" id="toga" onchange="hatinyaPKK('toga')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Toga
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="toga_komoditi_display" style="display: none">
                    <input type="text" name="toga_komoditi" onkeyup="valueToHatinyaPKK('toga')" id="toga_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="toga_kuantitas_display" style="display: none">
                    <input type="number" name="toga_kuantitas" onkeyup="valueToHatinyaPKK('toga')" id="toga_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_hatinya_pkk[]" id="tanaman_keras" onchange="hatinyaPKK('tanaman_keras')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Tanaman Keras
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="tanaman_keras_komoditi_display" style="display: none">
                    <input type="text" name="tanaman_keras_komoditi" onkeyup="valueToHatinyaPKK('tanaman_keras')" id="tanaman_keras_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="tanaman_keras_kuantitas_display" style="display: none">
                    <input type="number" name="tanaman_keras_kuantitas" onkeyup="valueToHatinyaPKK('tanaman_keras')" id="tanaman_keras_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_hatinya_pkk[]" id="lainnya" onchange="hatinyaPKK('lainnya')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Lainnya
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="lainnya_komoditi_display" style="display: none">
                    <input type="text" name="lainnya_komoditi" onkeyup="valueToHatinyaPKK('lainnya')" id="lainnya_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="lainnya_kuantitas_display" style="display: none">
                    <input type="number" name="lainnya_kuantitas" onkeyup="valueToHatinyaPKK('lainnya')" id="lainnya_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <label class="col-sm-4 col-form-label text-end fw-bold">UP2K <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="industri_rmh_up2k" id="industri_rmh_up2k" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="industri_rmh_up2k" id="industri_rmh_up2k" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
        <div id="jns_industri_rmh_up2k_display" style="display: none">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_industri_rmh_up2k[]" id="pangan" onchange="hatinyaPKK('pangan')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Pangan
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="pangan_komoditi_display" style="display: none">
                    <input type="text" name="pangan_komoditi" onkeyup="valueToHatinyaPKK('pangan')" id="pangan_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="pangan_kuantitas_display" style="display: none">
                    <input type="number" name="pangan_kuantitas" onkeyup="valueToHatinyaPKK('pangan')" id="pangan_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_industri_rmh_up2k[]" id="sandang" onchange="hatinyaPKK('sandang')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Sandang
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="sandang_komoditi_display" style="display: none">
                    <input type="text" name="sandang_komoditi" onkeyup="valueToHatinyaPKK('sandang')" id="sandang_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="sandang_kuantitas_display" style="display: none">
                    <input type="number" name="sandang_kuantitas" onkeyup="valueToHatinyaPKK('sandang')" id="sandang_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_industri_rmh_up2k[]" id="konveksi" onchange="hatinyaPKK('konveksi')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Konveksi
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="konveksi_komoditi_display" style="display: none">
                    <input type="text" name="konveksi_komoditi" onkeyup="valueToHatinyaPKK('konveksi')" id="konveksi_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="konveksi_kuantitas_display" style="display: none">
                    <input type="number" name="konveksi_kuantitas" onkeyup="valueToHatinyaPKK('konveksi')" id="konveksi_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_industri_rmh_up2k[]" id="jasa" onchange="hatinyaPKK('jasa')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Jasa
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="jasa_komoditi_display" style="display: none">
                    <input type="text" name="jasa_komoditi" onkeyup="valueToHatinyaPKK('jasa')" id="jasa_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="jasa_kuantitas_display" style="display: none">
                    <input type="number" name="jasa_kuantitas" onkeyup="valueToHatinyaPKK('jasa')" id="jasa_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-3 m-t-6">
                    <input type="checkbox" name="jns_industri_rmh_up2k[]" id="lainnya_up2k" onchange="hatinyaPKK('lainnya_up2k')" class="form-check-input add-required-form3">
                    <label class="form-check-label m-l-10">
                        Lainnya
                    </label>
                </div>
                <div class="col-sm-3 m-t-6" id="lainnya_up2k_komoditi_display" style="display: none">
                    <input type="text" name="lainnya_up2k_komoditi" onkeyup="valueToHatinyaPKK('lainnya_up2k')" id="lainnya_up2k_komoditi" placeholder="Komoditi" class="form-control add-required-form3" autocomplete="off">
                </div>
                <div class="col-sm-2 m-t-6" id="lainnya_up2k_kuantitas_display" style="display: none">
                    <input type="number" name="lainnya_up2k_kuantitas" onkeyup="valueToHatinyaPKK('lainnya_up2k')" id="lainnya_up2k_kuantitas" placeholder="Kuantitas" class="form-control add-required-form3" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <label class="col-sm-4 col-form-label text-end fw-bold">Aktivitas Kesehatan (PHBS) <span class="text-danger">*</span></label>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="0" name="kgtn_kshtn_lingkungan" id="kgtn_kshtn_lingkungan" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Tidak
                </label>
            </div>
            <div class="col-sm-4 m-t-6">
                <input type="radio" value="1" name="kgtn_kshtn_lingkungan" id="kgtn_kshtn_lingkungan" class="form-check-input add-required-form3">
                <label class="form-check-label m-l-10">
                    Ya
                </label>
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-4"></div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6 mb-2">
                        <button type="button" class="btn btn-block btn-warning fs-14 m-r-5" id="btnForm3Previous" onclick="stepperForm.previous()"><i class="bi bi-arrow-left m-r-8"></i>Kembali</button>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-block btn-info fs-14" id="btnForm3Next"><i class="bi bi-save m-r-8"></i>Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('script')
<script type="text/javascript">
    $('#btnForm3Previous').click(function() {
        $('.add-required-form3').prop('required', false)
    })

    // Hatinya PKK
    $("input[name='hatinya_pkk']").on('change', function(){
        val = $('input[name="hatinya_pkk"]:checked').val();
       
        if (val == 1) {
            $('#jns_hatinya_pkk_display').show();
        } else {
            $('#jns_hatinya_pkk_display').hide();
            $('#peternakan_komoditi_display,#peternakan_kuantitas_display,#perikanan_komoditi_display,#perikanan_kuantitas_display,#warung_hidup_komoditi_display,#warung_hidup_kuantitas_display,#toga_komoditi_display,#toga_kuantitas_display,#tanaman_keras_komoditi_display,#tanaman_keras_kuantitas_display,#lainnya_komoditi_display,#lainnya_kuantitas_display').hide();
            $("#peternakan_komoditi,#peternakan_kuantitas,#perikanan_komoditi,#perikanan_kuantitas,#warung_hidup_komoditi,#warung_hidup_kuantitas,#toga_komoditi,#toga_kuantitas,#tanaman_keras_komoditi,#tanaman_keras_kuantitas,#lainnya_komoditi,#lainnya_kuantitas").prop('required',false);
            $("#peternakan_komoditi,#peternakan_kuantitas,#perikanan_komoditi,#perikanan_kuantitas,#warung_hidup_komoditi,#warung_hidup_kuantitas,#toga_komoditi,#toga_kuantitas,#tanaman_keras_komoditi,#tanaman_keras_kuantitas,#lainnya_komoditi,#lainnya_kuantitas").val(null);
            $("#peternakan,#perikanan,#warung_hidup,#toga,#tanaman_keras,#lainnya").prop('checked',false);
        }
    });

    // UP2K
    $("input[name='industri_rmh_up2k']").on('change', function(){
        val = $('input[name="industri_rmh_up2k"]:checked').val();
       
        if (val == 1) {
            $('#jns_industri_rmh_up2k_display').show();
        } else {
            $('#jns_industri_rmh_up2k_display').hide();
            $('#pangan_komoditi_display,#pangan_kuantitas_display,#sandang_komoditi_display,#sandang_kuantitas_display,#konveksi_komoditi_display,#konveksi_kuantitas_display,#jasa_komoditi_display,#jasa_kuantitas_display,#lainnya_up2k_komoditi_display,#lainnya_up2k_kuantitas_display').hide();
            $("#pangan_komoditi,#pangan_kuantitas,#sandang_komoditi,#sandang_kuantitas,#konveksi_komoditi,#konveksi_kuantitas,#jasa_komoditi,#jasa_kuantitas,#lainnya_up2k_komoditi,#lainnya_up2k_kuantitas").prop('required',false);
            $("#pangan_komoditi,#pangan_kuantitas,#sandang_komoditi,#sandang_kuantitas,#konveksi_komoditi,#konveksi_kuantitas,#jasa_komoditi,#jasa_kuantitas,#lainnya_up2k_komoditi,#lainnya_up2k_kuantitas").val(null);
            $("#pangan,#sandang,#konveksi,#jasa,#lainnya_up2k").prop('checked',false);
        }
    });

    // Gotong Royong
    $("input[name='gotong_royong']").on('change', function(){
        val = $('input[name="gotong_royong"]:checked').val();
       
        if (val == 1) {
            $('#jns_gotong_royong_display').show();
            $("#jns_gotong_royong").prop('required',true);
            $("#jns_gotong_royong").select2({
                placeholder: "Pilih Jenis Gotong Rotong",
                allowClear: true
            });
        } else {
            $('#jns_gotong_royong_display').hide();
            $("#jns_gotong_royong").prop('required',false);
            $('#jns_gotong_royong').val(0).trigger("change.select2");
        }
    });

    // Kegiatan Pancasila
    $("input[name='kgtn_pancasila']").on('change', function(){
        val = $('input[name="kgtn_pancasila"]:checked').val();
       
        if (val == 1) {
            $('#jns_kgtn_pancasila_display').show();
            $("#jns_kgtn_pancasila").prop('required',true);
            $("#jns_kgtn_pancasila").select2({
                placeholder: "Pilih Jenis Kegiatan Pancasila",
                allowClear: true
            });
        } else {
            $('#jns_kgtn_pancasila_display').hide();
            $("#jns_kgtn_pancasila").prop('required',false);
            $('#jns_kgtn_pancasila').val(0).trigger("change.select2");
            $('#jns_kgtn_keagamaan').val(null);
        }

    });
    $('#jns_kgtn_pancasila').on('change', function() {
        val = $(this).val();
        find = val.find(value => value == 'Kegiatan Keagamaan');
        if (find) {
            $('#jns_kgtn_keagamaan').show();
        }else{
            $('#jns_kgtn_keagamaan').hide();
            $('#jns_kgtn_keagamaan').val(null);
        }
    })

    // Kelompok Belajar
    $("input[name='klmpk_belajar']").on('change', function(){
        val = $(this).val();
        if (val == 1) {
            $('#jns_klmpk_belajar_display').show();
            $("#jns_klmpk_belajar").prop('required',true);
        } else {
            $('#jns_klmpk_belajar_display').hide();
            $("#jns_klmpk_belajar").prop('required',false);
            $('#jns_klmpk_belajar').val(null).trigger("change.select2");
        }
    });

    // Kegiatan Koperasi
    $("input[name='kgtn_koperasi']").on('change', function(){
        val = $(this).val();
        if (val == 1) {
            $('#jns_kgtn_koperasi_display').show();
            $("#jns_kgtn_koperasi").prop('required',true);
            $('#jns_kgtn_koperasi').focus();
        } else {
            $('#jns_kgtn_koperasi_display').hide();
            $("#jns_kgtn_koperasi").prop('required',false);
            $('#jns_kgtn_koperasi').val(null);
        }
    });

    function hatinyaPKK(type){
        jenisHatinyaPKK  = '#'+type;
        komoditi         = '#'+type+'_komoditi';
        kuantitas        = '#'+type+'_kuantitas';
        komoditiDisplay  = '#'+type+'_komoditi_display';
        kuantitasDisplay = '#'+type+'_kuantitas_display';

        if ($(jenisHatinyaPKK).is(":checked")){
            $(komoditiDisplay+','+kuantitasDisplay).show();
            $(komoditi+','+kuantitas).prop('required',true);
        }else{
            $(komoditiDisplay+','+kuantitasDisplay).hide();
            $(komoditi+','+kuantitas).prop('required',false);
            $(komoditi+','+kuantitas).val(null);
        }
    }

    function valueToHatinyaPKK(type){
        typeKomoditi = '#'+type+'_komoditi';
        typeKuantitas = '#'+type+'_kuantitas';

        komoditi = $(typeKomoditi).val();
        kuantitas = $(typeKuantitas).val();

        value = type + ' / ' + komoditi +' / '+ kuantitas;
        $('#'+type).val(value);
    }

    function UP2K(type){
        jenisUP2K  = '#'+type;
        komoditi         = '#'+type+'_komoditi';
        kuantitas        = '#'+type+'_kuantitas';
        komoditiDisplay  = '#'+type+'_komoditi_display';
        kuantitasDisplay = '#'+type+'_kuantitas_display';

        if ($(jenisUP2K).is(":checked")){
            $(komoditiDisplay+','+kuantitasDisplay).show();
            $(komoditi+','+kuantitas).prop('required',true);
        }else{
            $(komoditiDisplay+','+kuantitasDisplay).hide();
            $(komoditi+','+kuantitas).prop('required',false);
            $(komoditi+','+kuantitas).val(null);
        }
    }

    function valueToUP2K(type){
        typeKomoditi = '#'+type+'_komoditi';
        typeKuantitas = '#'+type+'_kuantitas';

        komoditi = $(typeKomoditi).val();
        kuantitas = $(typeKuantitas).val();

        value = type + ' / ' + komoditi +' / '+ kuantitas;
        $('#'+type).val(value);
    }
</script>
@endpush