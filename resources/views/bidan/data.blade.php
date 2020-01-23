@extends('layouts.dashboard')
@section('title', 'Data')

@section('nav', 'Tampilkan Data')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
{{-- <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script> --}}



<div class="ui segment">

    <div class="ui container segment">
        <h2 class="header">
            Desa {{ Auth::user()->load('desa')->desa->nama}}
        </h2>
        <div class="ui divider"></div>
        <div>

            <canvas id="data_desa" width="800" height="400"></canvas>
        </div>
        {{-- <div id="chartContainer" style="height: 300px; width: 100%;"></div> --}}
    </div>


</div>



<style>
    .ui.segment {
        padding: 2em;
    }
</style>

<script>
    $.ajax ({
        url:'/data/desa',
        // data: data,
        type: "get",
        success: function(data){
            // setTimeout(function(){
                OnSuccess(data);
            // }, 1000);
        }
    });

    function OnSuccess(response) {
        var datas = {
            labels: [],
            datasets: [
                {
                    data: [],
                    backgroundColor: []
                }
            ]
        };

        $.each(response, function (idx, val) {
            console.log(val);
            if(val.kategori == "Sangat Tinggi") {
                datas.labels.push(val.kategori + ' (' + val.num +')');
                datas.datasets[0].data.push(val.num);
                datas.datasets[0].backgroundColor.push('#f44336');
            }

            if(val.kategori == "Tinggi") {
                datas.labels.push(val.kategori + ' (' + val.num +')');
                datas.datasets[0].data.push(val.num);
                datas.datasets[0].backgroundColor.push('#ffeb3b');
            }
            if(val.kategori == "Rendah") {
                datas.labels.push(val.kategori + ' (' + val.num +')');
                datas.datasets[0].data.push(val.num);
                datas.datasets[0].backgroundColor.push('#8bc34a');
            }

        });
        console.log(datas);
        var ctx = $("#data_desa").get(0).getContext("2d");
        var myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: datas,
            options: {
                title : {
                    display : true,
                    text : 'Grafik Persebaran Desa',
                    fontSize : 25,
                    padding : 15

                },
                responsive :false,
                animation : {
                    duration : 3000
                },
                legend:{
                    labels:{
                        boxWidth : 40,
                        padding : 20
                    },
                    display:true,
                    position : 'right'
                },
            }
        });
    }

    function OnErrorCall_(response) {
        console.log(error);
    }

</script>
@endsection