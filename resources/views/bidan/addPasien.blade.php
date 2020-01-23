@extends('layouts.dashboard')
@section('title', 'Add Pasien')

@section('nav', 'Tambah Pasien')
@section('content')


<div class="ui three top attached steps">
    <div class="active step">
        <i class="child icon"></i>
        <div class="content">
            <div class="title">Pasien</div>
            <div class="description">Tambahkan Info Pasien</div>
        </div>
    </div>
    <div class="disabled step">
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
    
    <form class="ui form" method="POST" action="{{ url('/pasien/add')}}">
        @csrf
        <div class="field">
            <label for="nama_istri">Nama Istri</label>
            <input type="text" name="nama_istri" placeholder="Nama Istri" value="{{isset($pasien) ? $pasien->nama_istri : ''}}" required>
        </div>

        <div class="field">
            <label for="nama_suami">Nama Suami</label>
            <input type="text" name="nama_suami" placeholder="Nama Suami" value="{{isset($pasien) ? $pasien->nama_suami : ''}}" required>
        </div>

        <div class="field">
            <label for="alamat">Alamat</label>
            <input type="text" name="alamat" placeholder="Alamat" value="{{isset($pasien) ? $pasien->alamat : ''}}" required>
        </div>

        <div class="field">
            <label for="nomor_hp">Nomor Hp</label>
            <input type="number" name="nomor_hp" placeholder="Nomor HP" value="{{isset($pasien) ? $pasien->nomor_hp : ''}}" required>
        </div>

        <div class="field">
            <label for="umur">Umur Istri</label>
            <input type="number" name="umur" placeholder="Umur" value="{{isset($pasien) ? $pasien->umur : ''}}" required>
        </div>

        {{-- <div class="field">
            <label for="nomor_hp">Tanggal Lahir</label>
            <div class="ui calendar" id="tanggal_lahir">
                <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="Date" name="tanggal_lahir">
                    <input type="hidden" name="ttl" class="tanggal_lahir" value="0">
                </div>
            </div>
        </div> --}}

        <div class="field">
            <button class="ui fluid blue button" name="submit" type="submit">Next</button>
        </div>
    </form>

</div>



<style>
    .ui.segment {
        padding: 2em;
    }
</style>
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
@endsection
