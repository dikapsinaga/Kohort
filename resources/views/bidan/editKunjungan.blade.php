<div class="ui small modal edit_kunjungan">
    <div class="header">Edit Data</div>
    <div class="content">

        <form id="form_edit" class="ui form" method="POST" action="">
            @csrf
            <input type="hidden" id="edit_kunjungan_id" value="0">
            <div class="four wide field">
                <label for="tangggal_kunjungan">Tanggal Kunjungan</label>
                <div class="ui calendar" id="edit_tanggal_kunjungan">
                    <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" placeholder="Date" name="edit_tanggal_kunjungan">
                        {{-- <input type="hidden" name="tanggal_kunjungan" class="tanggal_kunjungan" value="0"> --}}
                    </div>
                </div>
            </div>

            <div class="ten wide field">
                <label>Tempat Pelayanan</label>
                <div class="ui fluid multiple search selection dropdown tempat_pelayanan">
                    <input type="hidden" name="edit_tempat_pelayanan">
                    <i class="dropdown icon"></i>
                    <div class="default text" data-value="null">Tempat Pelayanan</div>
                    <div class="menu">
                        <div class="item" data-value="puskesmas">Puskesmas</div>
                        <div class="item" data-value="posyandu">Posyandu</div>
                        <div class="item" data-value="kunjungan_rumah">Kunjungan Rumah</div>
                        <div class="item" data-value="bidan_swasta">Bidan Praktek Swasta</div>
                        <div class="item" data-value="rumah_sakit">Rumah Sakit</div>
                    </div>
                </div>
            </div>

            <div class="ten wide field">
                <label>Kode Pelayanan</label>
                <div class="ui fluid multiple search selection dropdown kode_pelayanan">
                    <input type="hidden" name="edit_kode_pelayanan">
                    <i class="dropdown icon"></i>
                    <div class="default text" data-value="null">Kode Pelayanan</div>
                    <div class="menu">
                        <div class="item" data-value="k1">K1</div>
                        <div class="item" data-value="partus">Partus</div>
                        <div class="item" data-value="perkiraan_partus">Perkiraan Partus</div>
                        <div class="item" data-value="k4">K4</div>
                        <div class="item" data-value="kapsul_iodium">Kapsul Iodium</div>
                        <div class="item" data-value="vitamin_A">Vitamin A</div>
                        <div class="item" data-value="tablet_besi">Tablet Besi</div>
                        <div class="item" data-value="alat_kontrasepsi">Pemasangan Alat Kontrasepsi</div>
                        <div class="item" data-value="IUD">IUD</div>
                        <div class="item" data-value="kondom">Kondom</div>
                        <div class="item" data-value="mop">MOP</div>
                        <div class="item" data-value="mow">MOW</div>
                        <div class="item" data-value="suntik">Suntik</div>
                        <div class="item" data-value="implant">Implant</div>
                        <div class="item" data-value="test_hiv">Penwaran Test HIV</div>
                        <div class="item" data-value="terapi_arv">Terapi ARV</div>
                        <div class="item" data-value="imunisasi_tt">Imunisasi Tetanus Toksoid</div>
                        <div class="item" data-value="pemeriksaan_darah">Pemeriksaan Darah</div>
                        <div class="item" data-value="pemeriksaan_urine">Pemeriksaan Urine</div>
                        <div class="item" data-value="pemeriksaan_fundus_uteri">Pemeriksaan Tinggi Fundus Uteri</div>
                        <div class="item" data-value="pemeriksaan_denyut_jantung">Pemeriksaan Denyut Jantung Janin</div>
                        <div class="item" data-value="temu_wicara">Temu Wicara (KIE)</div>
                    </div>
                </div>
            </div>

            <div class="ten wide field">
                <label>Penyakit Yang Diderita</label>
                <div class="ui fluid multiple search selection dropdown penyakit">
                    <input type="hidden" name="edit_penyakit">
                    <i class="dropdown icon"></i>
                    <div class="default text" data-value="null">Penyakit</div>
                    <div class="menu">
                        <div class="item" data-value="anemia">Anemia</div>
                        <div class="item" data-value="malaria">Malaria</div>
                        <div class="item" data-value="tuberkolosa_paru">Tuberkolosa Paru</div>
                        <div class="item" data-value="payah_jantung">Payah Jantung</div>
                        <div class="item" data-value="kencing_manis">Kencing Manis (Diabetes)</div>
                        <div class="item" data-value="penyakit_menular">Penyakit Menular Seksual</div>
                        <div class="item" data-value="bengkak_muka_dan_tekanan_darah_tinggi">Bengkak Pada Muka/Tungkai
                            Dan Tekanan Darah Tinggi</div>
                        <div class="item" data-value="hamil_kembar">Hamil Kembar</div>
                        <div class="item" data-value="kembar_air">Kembar Air</div>
                        <div class="item" data-value="janin_mati">Janin Mati</div>
                        <div class="item" data-value="hamil_lebih">Hamil lebih bulan</div>
                        <div class="item" data-value="bayi_sungsang">Letak Bayi Sungsang</div>
                        <div class="item" data-value="bayi_lintang">Letak Bayi Lintang</div>
                        <div class="item" data-value="pendarahan">Pendarahan</div>
                        <div class="item" data-value="kejang">Pra-ekplempsia Berat/Kejang-kejang</div>

                    </div>
                </div>
            </div>

            {{-- <div class="field">
                <button class="ui right floated primary button" name="submit" type="submit" id="btn_tambah">
                    Tambah
                </button>
            </div> --}}

            <div class="actions">
                <div class="ui approve blue button" type="submit" id="btn_edit">Update</div>
                <div class="ui cancel button">Cancel</div>
            </div>

        </form>
    </div>
</div>


<script>
    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
    ;
</script>