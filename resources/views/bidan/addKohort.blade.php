@extends('layouts.dashboard')
@section('title', 'Add Kohort')

@section('nav', 'Tambah Kohort')
@section('content')


<div class="ui three top attached steps">
    <div class="step">
        <i class="child icon"></i>
        <div class="content">
            <div class="title">Pasien</div>
            <div class="description">Tambahkan Info Pasien</div>
        </div>
    </div>
    <div class="active step">
        <i class="edit icon"></i>
        <div class="content">
            <div class="title">Kohort</div>
            <div class="description">Tambahkan Info Kohort Ibu</div>
        </div>
    </div>
    <div class="disabled step">
        <i class="clock icon"></i>
        <div class="content">
            <div class="title">Kunjungan</div>
            <div class="description">Tambahkan Info Kunjungan</div>
        </div>
    </div>
</div>

<div class="ui attached segment">
    @if ($errors->any())
    <div class="ui error message">
        <i class="close icon"></i>
        <div class="header">
            There were some errors with your submission
        </div>
        <ul class="list">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form class="ui form" method="POST" action="{{ url('/pasien/addKohort')}}">
        @csrf

        <div class="four wide field">
            <label for="hamil">Hamil Ke-</label>
            <input type="number" name="hamil" placeholder="Hamil Ke-" value="{{isset($kohort) ? $kohort->hamil : ''}}" required>
        </div>

        <div class="fields">
            <div class="four wide field">
                <label for="berat_badan">Berat Badan(kg)</label>
                <input type="number" step="any" name="berat_badan" placeholder="Berat Badan" value="{{isset($kohort) ? $kohort->berat_badan : ''}}" required>
            </div>

            <div class="four wide field">
                <label for="tinggi_badan">Tinggi Badan(cm)</label>
                <input type="number" step="any" name="tinggi_badan" placeholder="Tinggi Badan" value="{{isset($kohort) ? $kohort->tinggi_badan : ''}}" required>
            </div>

            <div class="eight wide field">
                <label for="lingkar_lengan">Lingkar Lengan(cm)</label>
                <input type="number" step="any" name="lingkar_lengan" placeholder="Lingkar Lengan" value="{{isset($kohort) ? $kohort->lingkar_lengan : ''}}" required>
            </div>
        </div>

        <div class="fields">

            <div class="eight wide field">
                <label for="haemoglobin">Haemoglobin (g/dL) </label>
                <input type="number" step="any" name="haemoglobin" placeholder="Haemoglobin" value="{{isset($kohort) ? $kohort->haemoglobin : ''}}" required>
            </div>

            <div class="four wide field">
                <label for="sistole">Sistole (mmHg)</label>
                <input type="number" name="sistole" placeholder="Sistole" value="{{isset($kohort) ? $kohort->sistole : ''}}" required>
            </div>

            <div class="four wide field">
                <label for="diastole">Diastole (mmHg)</label>
                <input type="number" name="diastole" placeholder="Diastole" value="{{isset($kohort) ? $kohort->diastole : ''}}" required>
            </div>
        </div>

        <div class="fields">
            <div class="four wide field">
                <label for="jarak_kehamilan">Jarak Kehamilan</label>
                <input type="number" step="any" name="jarak_kehamilan" placeholder="Jarak Kehamilan" value="{{isset($kohort) ? $kohort->jarak_kehamilan : '0'}}" required>
            </div>

        </div>

        <div class="ten wide field">
            <label>Riwayat melahirkan</label>
            <div class="ui fluid multiple search selection dropdown">
                <input type="hidden" name="riwayat_melahirkan" >
                <i class="dropdown icon"></i>
                <div class="default text" data-value="null">Penyakit</div>
                <div class="menu">
                    <div class="item" data-value="tang_vakum">Tarikan tang/vakum</div>
                    <div class="item" data-value="uji_dirogoh" >Uji dirogoh</div>
                    <div class="item" data-value="infus_transfusi">Diberi infus/Transfusi</div>
                </div>
            </div>
        </div>


        {{-- <div class="three wide fields"> --}}
        <div class="grouped fields">
            <label for="gagal_hamil">Pernah mengalami gagal kehamilan ?</label>
            <div class="field">
                <div class="ui radio checkbox">
                    <input type="radio" name="gagal_hamil" value="1" tabindex="0" class="hidden" {{ (isset($kohort) && $kohort->gagal_hamil == '1') ? "checked" : ""}} required>
                    <label>Ya</label>
                </div>
            </div>
            <div class="field">
                <div class="ui radio checkbox">
                    <input type="radio" name="gagal_hamil" value="0" tabindex="0" class="hidden" {{ (isset($kohort) && $kohort->gagal_hamil == '0') ? "checked" : ""}}>
                    <label>Tidak</label>
                </div>
            </div>
        </div>

        <div class="grouped fields">
            <label for="gagal_hamil">Pernah menagalami operasi sesar ?</label>
            <div class="field">
                <div class="ui radio checkbox">
                    <input type="radio" name="operasi_sesar" value="1" tabindex="0" class="hidden" {{ (isset($kohort) && $kohort->operasi_sesar == '1') ? "checked" : ""}} required>
                    <label>Ya</label>
                </div>
            </div>
            <div class="field">
                <div class="ui radio checkbox">
                    <input type="radio" name="operasi_sesar" value="0" tabindex="0" class="hidden" {{ (isset($kohort) && $kohort->operasi_sesar == '0') ? "checked" : ""}}>
                    <label>Tidak</label>
                </div>
            </div>
        </div>

        <input type="hidden" id="helper" value="{{isset($kohort) ? $kohort->riwayat_melahirkan : ''}}">

        <div class="field">
            <button class="ui primary right floated button" name="submit" type="submit">
                Next
            </button>
        </div>

        <form class="ui form">
            <input type="button" class="ui button" value="Back" onclick="window.location.href='/pasien/PasienForm'" />
        </form>

    </form>

</div>



<style>
    .ui.segment {
        padding: 2em;
    }
</style>
<script>
    $('.ui.radio.checkbox').checkbox();
    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
    ;
    $('.ui.dropdown').dropdown();

    

    $(document).ready(function(){
        if($('#helper').val() != null){
            var riwayat_melahirkan = $('#helper').val();
            $.each(riwayat_melahirkan.split(","), function(i,e){
                    $('.ui.dropdown').dropdown('set selected', e);
                });

        }

    });




    // $('.ui.dropdown').dropdown();







</script>
@endsection
