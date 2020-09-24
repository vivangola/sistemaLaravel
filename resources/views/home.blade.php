@extends('templates.template')
@section('title','Inicio')

@section('titulo','Tela Inicial')
@section('icone','fa fa-home')

@section('content')

<div class="row">
    <div class="col-md-6 col-lg-3">
        <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
            <div class="info">
                <h4>Total Contas</h4>
                <p><b>{{ $contas }}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
                <h4>Contas Ativas</h4>
                <p><b>{{ $ativas }}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-thumbs-o-down fa-3x"></i>
            <div class="info">
                <h4>Contas Em Débito</h4>
                <p><b>{{ $debito }}</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small dark coloured-icon"><i class="icon fa fa-times fa-3x"></i>
            <div class="info">
                <h4>Óbitos</h4>
                <p><b>{{ $obitos }}</b></p>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Novas Contas por Mês</h3>
            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="barChartDemo2"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="tile">
            <h3 class="tile-title">Faturamento Mensalidades - {{ date('yy') }} </h3>
            <div class="embed-responsive embed-responsive-16by9">
                <canvas class="embed-responsive-item" id="barChartDemo"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">&nbsp;
        </div>
    </div>
</div>

<!-- Charts -->
<script type="text/javascript">
    var data = {
        labels: ["Janeiro", "Feveiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro"],
        datasets: [{
            label: "My First dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [18000, 16200, 16700, 17500, 17000, 18000, 21000, 24000, 23000]
        }]
    };
    var ctxb = $("#barChartDemo").get(0).getContext("2d");
    var barChart = new Chart(ctxb).Bar(data);
    var data2 = {
        labels: ["Janeiro", "Feveiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro"],
        datasets: [{
            label: "My First dataset",
            fillColor: "rgba(0,150,136,0.2)",
            strokeColor: "rgba(0,150,136,1)",
            pointColor: "rgba(0,150,136,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(0,150,136,1)",
            data: [28, 48, 40, 19, 26, 28, 48, 40, 19]
        }]
    };
    var ctxb2 = $("#barChartDemo2").get(0).getContext("2d");
    var barChart2 = new Chart(ctxb2).Bar(data2);
</script>
@endsection