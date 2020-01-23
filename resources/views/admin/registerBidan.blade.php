@extends('layouts.dashboard')
@section('title', 'Create Account')

@section('nav', 'Tambah Akun')
@section('content')


<div class="ui segment">
    <form class="ui form" method="POST" action="{{ url('/admin/users/createUser')}}">
        @csrf
        <div class="field">
            <label for="name">Nama Lengkap</label>
            <input type="text" name="name" placeholder="Name" required>
        </div>

        <div class="field">
            <label for="email">Alamat Email</label>
            <input type="email" name="email" placeholder="Email" required>
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="field">
            <label for="password_confirmation">Konfimasi Password</label>
            <input type="password" name="password_confirmation" placeholder="Enter Password Again" required>
        </div>

        <div class="field">
            <label for="Puskesmas">Puskesmas</label>
            <select class="ui disabled dropdown" name="id_puskesmas">
                <option value="{{Auth::user()->id_puskesmas}}">{{$nama_puskesmas}}</option>
            </select>
        </div>

        <div class="field">
            <label for="Desa">Desa</label>
            <select class="ui dropdown" name="id_desa">
                <option value="">Desa</option>
                @foreach ($list_desa as $desa)
                    <option value="{{$desa->id}}">{{$desa->nama}}</option>
                @endforeach
            </select>
        </div>
        <div class="field">
            <button class="ui fluid blue button" name="submit" type="submit">Tambah</button>
        </div>
    </form>

</div>


<style>
    .ui.segment {
        padding: 2em;
    }
</style>
<script>
    $('.ui.dropdown')
  .dropdown()
;
</script>
@endsection
