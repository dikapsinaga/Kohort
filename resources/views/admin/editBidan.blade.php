<div class="ui small modal" id="edit_modal">
    <div class="header">Edit Data</div>
    <div class="content">
        <form class="ui form" id="form_edit" method="POST" action="">
            @csrf
            <input id="edit_user_id" name="user_id" type="hidden" value="0">

            <div class="field">
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" placeholder="Name" required id="nama">
            </div>

            <div class="field">
                <label for="email">Alamat Email</label>
                <input type="email" name="email" placeholder="Email" required id="email">
            </div>

            {{-- <div class="field">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Password" required id="password">
            </div>

            <div class="field">
                <label for="password_confirmation">Konfimasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Enter Password Again" required>
            </div> --}}

            <div class="field">
                <label for="Puskesmas">Puskesmas</label>
                <select class="ui disabled dropdown" name="id_puskesmas">
                    <option value="" id="puskesmas">XX</option>
                </select>
            </div>

            <div class="field">
                <label for="Desa">Desa</label>
                <select class="ui dropdown" name="id_desa" id="desa">
                    <option value="">Desa</option>
                </select>
            </div>
            
            <div class="actions">
                <div class="ui approve blue button" type="submit" id="btn_edit">Update</div>
                <div class="ui cancel button">Cancel</div>
            </div>
            {{-- <div class="field">
                <button class="ui fluid blue button" name="submit" type="submit">Tambah</button>
            </div> --}}
        </form>
    </div>
</div>


<div class="ui small modal" id="success_message">
    <div class="header">Success Data</div>
    <div class="content">
        Berhasil
    </div>
    <div class="actions">
            <div class="ui approve blue button" type="submit" id="btn_edit">Oke</div>
        </div>
</div>
