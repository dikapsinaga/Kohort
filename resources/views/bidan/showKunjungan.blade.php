@extends('layouts.dashboard')
@section('title', 'Kunjungan')

@section('nav', 'Kunjungan')
@section('content')


<div class="ui three top attached steps">
    <div class="step">
        <i class="child icon"></i>
        <div class="content">
            <div class="title">Pasien</div>
            <div class="description">Tambahkan Info Pasien</div>
        </div>
    </div>
    <div class="step">
        <i class="edit icon"></i>
        <div class="content">
            <div class="title">Kohort</div>
            <div class="description">Tambahkan Info Kohort Ibu</div>
        </div>
    </div>
    <div class="active step">
        <i class="clock icon"></i>
        <div class="content">
            <div class="title">Kunjungan</div>
            <div class="description">Tambahkan Info Kunjungan</div>
        </div>
    </div>
</div>

<div class="ui attached segment">

    {{-- <div class="ui teal segment">Teal</div> --}}

    <a href="#" onclick="event.preventDefault();addKunjunganForm()">
        <button id="button_showForm" class="ui right floated teal button" type="submit">
            <i class="user plus icon"></i>
            Tambah Kunjungan
        </button>
    </a>

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
                <th class="two wide">Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($kunjungans as $kunjungan)
            <tr class="kunjungan{{$kunjungan->id}}">
                <td>
                    {{-- <h2 class="ui center aligned header"> --}}
                    {{Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('j F Y')}}
                    {{-- {{$kunjungan->tanggal_kunjungan}} --}}
                    {{-- </h2> --}}
                </td>

                <td class="left aligned">
                    @foreach (explode(',', $kunjungan->tempat_pelayanan) as $item)
                    <ul class="ui list">
                        <li>{{$item}}</li>
                    </ul>
                    @endforeach
                    {{-- {{$kunjungan->tempat_pelayanan}} --}}
                </td>

                <td class="left aligned">
                    @foreach (explode(',', $kunjungan->kode_pelayanan) as $item)
                    <ul class="ui list">
                        <li>{{$item}}</li>
                    </ul>
                    @endforeach
                    {{-- {{$kunjungan->tempat_pelayanan}} --}}
                    {{-- <div class="ui star rating" data-rating="3" data-max-rating="3"></div> --}}
                </td>

                <td class="left aligned">
                    {{-- @if ($kunjungan != null) --}}
                        @foreach (explode(',', $kunjungan->penyakit) as $item)
                        <ul class="ui list">
                            <li>{{$item}}</li>
                        </ul>
                        @endforeach
                        
                    {{-- @endif --}}
                    {{-- {{$kunjungan->penyakit}} --}}
                </td>

                <td>
                    <a onclick="event.preventDefault();editKunjunganForm({{$kunjungan->id}})" href="#">
                        <i class="pencil alternate icon"></i>
                    </a>

                    <a onclick="event.preventDefault();deleteKunjunganForm({{$kunjungan->id}});" href="#">
                        <i class="trash icon"></i>
                    </a>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <form class="ui form">
        <input type="button" class="ui button" value="Back" onclick="window.location.href='/pasien/KohortForm'" />
        <input type="button" class="ui right floated teal button" value="Save"
            onclick="window.location.href='/pasien'" />

    </form>

</div>


@include('bidan.addKunjungan')
@include('bidan.editKunjungan')
@include('bidan.deleteKunjungan')


<style>
    .ui.segment {
        padding: 2em;
    }

    #button_showForm {
        margin: 20px;
    }
</style>

<script>
    $(document).on('click', '#btn_tambah', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: '/pasien/addKunjungan',
            data: {
                tanggal_kunjungan: $("#form_add input[name=add_tanggal_kunjungan]").val(),
                tempat_pelayanan: $("#form_add input[name=add_tempat_pelayanan]").val(),
                kode_pelayanan: $("#form_add input[name=add_kode_pelayanan]").val(),
                penyakit: $("#form_add input[name=add_penyakit]").val(),
            },
            dataType : 'json',
            success: function(data) {
                console.log(data);
                $("#form_add input[name=add_tanggal_kunjungan]").val('');
                $('.ui.dropdown').dropdown('clear');
                $('.ui.modal.add_kunjungan').modal('hide');
                window.location.reload();
            },
            error: function(data) {
                var errors = $.parseJSON(data.responseText);
                $('#add_error_task').html('');

                $.each(errors.messages, function(key, value) {
                    $('#add_error_task').append('<li>' + value + '</li>');
                });

                $('#add_error_bag').show();
                $('.message .close')
                    .on('click', function() {
                        $(this)
                            .closest('.message')
                            .transition('fade')
                    ;
                });


            }
        });
    });


    $(document).on('click', '#btn_edit', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'PUT',
            url: '/pasien/EditKunjungan/' + $('#edit_kunjungan_id').val(),
            data: {
                tanggal_kunjungan: $("#form_edit input[name=edit_tanggal_kunjungan]").val(),
                tempat_pelayanan: $("#form_edit input[name=edit_tempat_pelayanan]").val(),
                kode_pelayanan: $("#form_edit input[name=edit_kode_pelayanan]").val(),
                penyakit: $("#form_edit input[name=edit_penyakit]").val(),
            },
            dataType : 'json',
            success: function(data) {
                console.log(data);
                $('.ui.modal.edit_kunjungan').modal('hide');
                window.location.reload();
            },
            error: function(data) {
                console.log(data);
                var errors = $.parseJSON(data.responseText);
                $('#edit_error_task').html('');

                $.each(errors.messages, function(key, value) {
                    $('#edit_error_task').append('<li>' + value + '</li>');
                });

                $('#edit_error_bag').show();
                $('.message .close')
                    .on('click', function() {
                        $(this)
                            .closest('.message')
                            .transition('fade')
                    ;
                });

            }
        });

    });

    $(document).on('click', '#btn_delete', function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'DELETE',
            url: '/pasien/DeleteKunjungan/' + $('#delete_kunjungan_id').val(),
            dataType : 'json',
            success: function(data) {
                console.log(data);
                $('.kunjungan' + $('#delete_kunjungan_id').val()).remove();

                // window.location.reload();
            },
            error: function(data) {
                console.log(data);
            }
        });

    });


    function addKunjunganForm(){
        $.ajax({
            type: 'GET',
            url : '/pasien/AddKunjunganForm',
            success : function(data){
                console.log(data);

                $('.ui.modal.add_kunjungan').modal({
                    onShow: function(){
                        $('#add_error_bag').hide();
                        $('#add_tanggal_kunjungan').calendar({
                            type: 'date'
                        });
                        $('.ui.dropdown').dropdown();
                    },
                    onApprove: function (click) {
                        return false;
                    }
                    

                }).modal('show');

            }
        })
    };


    function editKunjunganForm(id){
        $.ajax({
            type: 'GET',
            url : '/pasien/EditKunjunganForm/' + id,
            success : function(data){
                console.log(data.kunjungan);
                $('.ui.modal.edit_kunjungan').modal({
                    onShow: function(){
                        $('#edit_error_bag').hide();

                        $('#edit_kunjungan_id').val(data.kunjungan.id);

                        $('#edit_tanggal_kunjungan').calendar(
                            'set date', data.kunjungan.tanggal_kunjungan).calendar({
                                type :'date'
                            });

                        $.each(data.kunjungan.tempat_pelayanan.split(","), function(i,e){
                            $('.ui.dropdown.tempat_pelayanan').dropdown('set selected', e);
                        });

                        $.each(data.kunjungan.kode_pelayanan.split(","), function(i,e){
                            $('.ui.dropdown.kode_pelayanan').dropdown('set selected', e);
                        });

                        if(data.kunjungan.penyakit != null){
                            $.each(data.kunjungan.penyakit.split(","), function(i,e){
                                $('.ui.dropdown.penyakit').dropdown('set selected', e);
                            });

                        }
                        else{
                            $('.ui.dropdown').dropdown();

                        }

                    },
                    onApprove: function (click) {
                        return false;
                    }

                }).modal('show');

            }
        })
    };

    function deleteKunjunganForm(id){
        $.ajax({
            type: 'GET',
            url : '/pasien/DeleteKunjunganForm/' + id,
            success : function(data){
                console.log(data.kunjungan);
                $('#delete_kunjungan_id').val(data.kunjungan.id);
                $('.ui.modal.delete_kunjungan').modal('show');
            }
        })
    };

</script>
@endsection