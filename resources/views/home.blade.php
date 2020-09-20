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
                <p><b>5498</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small info coloured-icon"><i class="icon fa fa-thumbs-o-up fa-3x"></i>
            <div class="info">
                <h4>Contas Ativas</h4>
                <p><b>3564</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small danger coloured-icon"><i class="icon fa fa-thumbs-o-down fa-3x"></i>
            <div class="info">
                <h4>Contas Em Débito</h4>
                <p><b>651</b></p>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="widget-small dark coloured-icon"><i class="icon fa fa-times fa-3x"></i>
            <div class="info">
                <h4>Óbitos</h4>
                <p><b>17</b></p>
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
    @endsection