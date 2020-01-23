@extends('layouts.dashboard')
@section('title', 'Home')

@section('content')
@section('nav', 'Home')

<h3 class="ui top attached header">
    Selamat datang,
</h3>


<div class="ui attached segment">
    <img class="ui small right floated image" src="{{asset('img/kotabatu.png')}}">
    <p>
        Aplikasi bristi. dibangun untuk pemanfaatan teknologi informasi dalam rangka pencegahan dini terhadap risiko ibu
        hamil. Sehingga harapannya dengan menggunakan sistem ini koreksi dan penanganan dapat memperkecil kematian janin
        pada ibu hamil.
    </p>

    <p>
        Aplikasi bristi. menentukan risiko ibu hamil berdasarkan penelitian yang dilakukan oleh Dr. Poedji Rochjati.
        Pada penelitian ini ibu hamil dikategorikan menjadi 3 yaitu Kehamilan Risiko Rendah (KRR), Kehamilan Risiko
        Tinggi (KRT), Kehamilan Risiko Sangat Tinggi (KRST).
    </p>

    <p>
        Pembagian 3 kategori ini berdasarkan hasil skor yang didapati oleh ibu. Adapun syarat penggolngan dari kategori
        tersebut adalah sebagai berikut
    </p>

    {{-- <br> --}}

    <table class="ui very basic celled table">
        <thead>
            <tr class="center aligned">
                <th>Skor</th>
                <th>Risiko</th>
                <th>Rujukan</th>
            </tr>
        </thead>
        <tbody>
            <tr class="positive center aligned">
                <td>2</td>
                <td>Rendah</td>
                <td>Tidak Dirujuk</td>
            </tr>
            <tr class="warning center aligned">
                <td>6-10</td>
                <td>Tinggi</td>
                <td>Bidan PKM</td>
            </tr>
            <tr class="negative center aligned">
                <td>>= 12</td>
                <td>Sangat Tinggi</td>
                <td>Rumah Sakit</td>
            </tr>
        </tbody>
    </table>


</div>

<style>
    .ui.top.attached.header {
        font-size: 1.8em;
        line-height: 1em;
        padding: 0.8em;
    }

    .ui.attached.segment {
        font-size: 1em;
        padding: 2.5em;
    }

    p {
        margin: 0 0 1em;
        font-size: 1.13rem;
        line-height: 1.8rem;
        font-kerning: 1rem;

    }
</style>


@endsection