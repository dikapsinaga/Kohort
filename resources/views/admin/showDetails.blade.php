<div class="ui large modal details">
    <div class="header">Details Data</div>
    <div class="scrolling content">

        <form id="form_details" class="ui form">
            @csrf
            <h3 class="ui header">Data Pasien</h3>
            <div class="ui section divider"></div>

            <div class="fields">
                <div class="four wide field">
                    <label for="nama_istri">Nama Istri</label>
                    <input type="text" name="nama_istri" placeholder="Nama Istri" readonly>
                </div>

                <div class="four wide field">
                    <label for="nama_suami">Nama Suami</label>
                    <input type="text" name="nama_suami" placeholder="Nama Suami" readonly>
                </div>

                <div class="eight wide field">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" placeholder="Alamat" readonly>
                </div>

            </div>

            <div class="fields">
                <div class="four wide field">
                    <label for="nomor_hp">Nomor Hp</label>
                    <input type="number" name="nomor_hp" placeholder="Nomor HP" readonly>
                </div>

                <div class="four wide field">
                    <label for="umur">Umur Istri</label>
                    <input type="number" name="umur" placeholder="Umur" readonly>
                </div>
            </div>

            <br>
            <h3 class="ui header">Data Kohort</h3>
            <div class="ui section divider"></div>

            <div class="four wide field">
                <label for="hamil">Hamil Ke-</label>
                <input type="number" name="hamil" placeholder="Hamil Ke-" value="" readonly>
            </div>

            <div class="fields">
                <div class="four wide field">
                    <label for="berat_badan">Berat Badan(kg)</label>
                    <input type="number" step="any" name="berat_badan" placeholder="Berat Badan" value="" readonly>
                </div>

                <div class="four wide field">
                    <label for="tinggi_badan">Tinggi Badan(cm)</label>
                    <input type="number" step="any" name="tinggi_badan" placeholder="Tinggi Badan" value="" readonly>
                </div>

                <div class="eight wide field">
                    <label for="lingkar_lengan">Lingkar Lengan(cm)</label>
                    <input type="number" step="any" name="lingkar_lengan" placeholder="Lingkar Lengan" value=""
                        readonly>
                </div>
            </div>

            <div class="fields">

                <div class="eight wide field">
                    <label for="haemoglobin">Haemoglobin (g/dL) </label>
                    <input type="number" step="any" name="haemoglobin" placeholder="Haemoglobin" value="" readonly>
                </div>

                <div class="four wide field">
                    <label for="sistole">Sistole (mmHg)</label>
                    <input type="number" name="sistole" placeholder="Sistole" value="" readonly>
                </div>

                <div class="four wide field">
                    <label for="diastole">Diastole (mmHg)</label>
                    <input type="number" name="diastole" placeholder="Diastole" value="" readonly>
                </div>
            </div>

            <div class="fields">
                <div class="four wide field">
                    <label for="jarak_kehamilan">Jarak Kehamilan</label>
                    <input type="number" step="any" name="jarak_kehamilan" placeholder="Jarak Kehamilan" value=""
                        readonly>
                </div>

            </div>

            <div class="ten wide field">
                <label>Riwayat melahirkan</label>
                <div class="ui fluid multiple search selection dropdown">
                    <input type="hidden" name="riwayat_melahirkan" disabled>
                    <i class="dropdown icon"></i>
                    <div class="default text" data-value="null">Penyakit</div>
                    <div class="menu">
                        <div class="item" data-value="tang_vakum">Tarikan tang/vakum</div>
                        <div class="item" data-value="uji_dirogoh">Uji dirogoh</div>
                        <div class="item" data-value="infus_transfusi">Diberi infus/Transfusi</div>
                    </div>
                </div>
            </div>

            <div class="grouped fields">
                <label for="gagal_hamil">Pernah mengalami gagal kehamilan ?</label>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="gagal_hamil" value="1" tabindex="0" disabled>
                        <label>Ya</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="gagal_hamil" value="0" tabindex="0" disabled>
                        <label>Tidak</label>
                    </div>
                </div>
            </div>

            <div class="grouped fields">
                <label for="operasi_sesar">Pernah menagalami operasi sesar ?</label>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="operasi_sesar" value="1" tabindex="0" disabled>
                        <label>Ya</label>
                    </div>
                </div>
                <div class="field">
                    <div class="ui radio checkbox">
                        <input type="radio" name="operasi_sesar" value="0" tabindex="0" disabled>
                        <label>Tidak</label>
                    </div>
                </div>
            </div>

            <h3 class="ui header">Data Kunjungan</h3>
            <div class="ui section divider"></div>

            <table id="kunjungan" class="ui striped celled teal table" style="
    /* table-layout: fixed;  */
    /* white-space: pre-wrap; */
    /* white-space: -o-pre-wrap; */
    /* white-space: -moz-pre-wrap; */
    /* white-space: -hp-pre-wrap; */
    /* word-wrap: break-word */
    ">
                <thead>
                    <tr>
                        <th class="two wide">Tanggal Kunjungan</th>
                        <th class="four wide">Tempat Pelayanan</th>
                        <th class="four wide">Kode Pelayanan</th>
                        <th class="four wide">Penyakit</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>




        </form>


    </div>

    <div class="actions">
        <div class="ui approve button">Next</div>
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