@extends('layouts.dashboard')
@section('title', 'Data')

@section('nav', 'Tampilkan Data')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>


<div class="ui segment">

    <div class="ui container segment">
        <h2 class="header">
            Kota Batu
        </h2>
        <div class="ui divider"></div>
        <div>
            <canvas id="allData" width="800" height="400"></canvas>
        </div>
    </div>

    <div class="ui two stackable cards">

        @foreach ($puskesmas as $item)
            <div class="card">
                <div class="content">
                    <h2 class="header">Puskesmas {{$item->nama}}</h2>
                    <div class="ui divider"></div>
                    <canvas id="puskesmas_{{$item->id}}" width="300" height="200"></canvas>
                </div>
            </div>            
        @endforeach

    </div>

</div>

<style>
    .ui.segment {
        padding: 2em;
    }
</style>

<script>

function getAll(){
        $.ajax ({
            url:'/superAdmin/data/all',
            type: "get",
            success: function(data){
                OnSuccess(data);
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

            var ctx = $("#allData").get(0).getContext("2d");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: datas,
                options: {
                    title : {
                        display : true,
                        text : 'Grafik Persebaran',
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
    }


    function getPuskesmas(id){
        $.ajax ({
            url:'/superAdmin/data/puskesmas/' + id,
            type: "get",
            success: function(data){
                OnSuccess(data);
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

            var ctx = $('#puskesmas_'+id+'').get(0).getContext("2d");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: datas,
                options: {
                    title : {
                        display : true,
                        text : 'Grafik Persebaran',
                        fontSize : 20,
                        // padding : 15

                    },
                    // responsive :false,
                    animation : {
                        duration : 3000
                    },
                    legend:{
                        labels:{
                            // boxWidth : 40,
                            // padding : 20
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
    }

    $(document).ready(function(){
        getAll();

        var puskesmas = {!! json_encode($puskesmas);!!};
        puskesmas.forEach(element => {
            getPuskesmas(element.id);
        });

    });

    

</script>
@endsection