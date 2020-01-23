@extends('layouts.dashboard')
@section('title', 'Pasien')

@section('nav', 'Tampilkan Pasien')
@section('content')


<div class="ui segment">

    <a href="/pasien/PasienForm">
        <button id="button_showForm" class="ui teal button" type="submit">
            <i class="user plus icon"></i>
            Tambah Pasien
        </button>
    </a>

    <table id="pasien" class="ui striped celled teal table">
        <thead>
            <tr>
                <th>Nama Istri</th>
                <th>Nama Suami</th>
                <th>Alamat</th>
                <th>Umur</th>
                <th>Skor</th>
                <th>Kategori</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>

            <tr class="">
                <td>XX</td>
                <td>XX</td>
                <td>XX</td>
                <td>XX</td>
                <td>XX</td>
                <td>XX</td>
                <td>XX</td>
            </tr>

        </tbody>
    </table>

</div>

@include('bidan.deletePasien')



<style>
    .ui.segment {
        padding: 2em;
    }

    #button_showForm {
        margin: 20px;
    }
</style>

<script>
    var table = "";

    $(document).ready(function(){
        table = $('#pasien').DataTable({
            processing : true,
            ajax : {
                url : '/pasien/getListPasien',
                method : 'GET',
                dataSrc : 'pasien'
            }, 
            columns : [
                {data : 'nama_istri'},
                {data : 'nama_suami'},
                {data : 'alamat'},
                {data : 'umur'},
                {data : 'skor'},
                {data : 'kategori'},
                {
                    data : "id",
                    className : "center",
                    render : function (data, type, row, meta){
                        return '<a onclick= "event.preventDefault();editKunjunganForm('+data+')" href="#"><i class="pencil alternate icon"></i></a> <a onclick= "event.preventDefault();deleteKunjunganForm('+data+')" href="#"><i class="trash icon"></i></a>';
                    }
                },
            ]
        });


    });


    $(document).on('click', '#btn_delete', function(){
        console.log($('#delete_pasien_id').val());
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'DELETE',
            url: '/pasien/DeletePasien/' + $('#delete_pasien_id').val(),
            dataType : 'json',
            success: function(data) {
                table.ajax.reload(null, false);
            },
            error: function(data) {
                console.log(data);
            }
        });

    });


    function editKunjunganForm(id){
        $.ajax({
            type: 'GET',
            url : '/pasien/setPasienSession/' + id,
            success : function(data){
                console.log(data)
                location.href = "{{url('/pasien/PasienForm')}}";
            }
        })
    };

    function deleteKunjunganForm(id){
        $.ajax({
            type: 'GET',
            url : '/pasien/DeletePasienForm/' + id,
            success : function(data){
                console.log(data);
                $('#delete_pasien_id').val(data.pasien.id);
                $('.ui.modal.delete_pasien').modal('show');

            }
        })
    };

</script>
@endsection