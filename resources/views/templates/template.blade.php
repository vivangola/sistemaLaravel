<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="description" content="">

        <!-- Twitter meta-->
        <meta property="twitter:card" content="">
        <meta property="twitter:site" content="">
        <meta property="twitter:creator" content="">
        <!-- Open Graph Meta-->
        <meta property="og:type" content="website">
        <meta property="og:site_name" content="">
        <meta property="og:title" content="">
        <meta property="og:url" content="">
        <meta property="og:image" content="">
        <meta property="og:description" content="">
        <title>@yield('title') - Sysvangola</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="{{ url('assets/css/main.css') }}">
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="app sidebar-mini">
        
        <script type="text/javascript" src="{{ url('assets/js/plugins/sweetalert.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/jquery-3.3.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/plugins/chart.js') }}" ></script>

        <!-- Header-->
        @include('templates.header')

        <!-- Sidebar menu-->
        @include('templates.sidebar')

        <!-- Main Content -->
        <main class="app-content">        
            <div class="app-title">
                <div>
                    <h1>
                        <h1><i class="@yield('icone')"></i>&nbsp;&nbsp;@yield('titulo')
                    </h1>
                </div>
                <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"></li>
                </ul>
            </div>
            @yield('content')
        </main>

        <!-- Footer -->
        @include('templates.footer')

        <!-- Essential javascripts for application to work-->
        <script src="{{ url('assets/js/popper.min.js') }}"></script>
        <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('assets/js/main.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/plugins/bootstrap-notify.min.js') }}"></script>
        <script src="{{ url('assets/js/plugins/pace.min.js') }}"></script>
        <script src="{{ url('assets/js/script.js' )}}"></script>
            
        <!-- Google analytics script-->
        <script type="text/javascript">
            if(document.location.hostname == 'pratikborsadiya.in') {
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
                ga('create', 'UA-72504830-1', 'auto');
                ga('send', 'pageview');
            }
        </script>

        <!-- Charts -->
        <script type="text/javascript">
            var data = {
                labels: ["Janeiro", "Feveiro", "Março", "Abril", "Maio","Junho", "Julho", "Agosto", "Setembro"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(151,187,205,0.2)",
                        strokeColor: "rgba(151,187,205,1)",
                        pointColor: "rgba(151,187,205,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: [18000,16200,16700,17500,17000,18000,21000,24000,23000]
                    }
                ]
            };
            var ctxb = $("#barChartDemo").get(0).getContext("2d");
            var barChart = new Chart(ctxb).Bar(data);
            var data2 = {
                labels: ["Janeiro", "Feveiro", "Março", "Abril", "Maio","Junho", "Julho", "Agosto", "Setembro"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(0,150,136,0.2)",
                        strokeColor: "rgba(0,150,136,1)",
                        pointColor: "rgba(0,150,136,1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(0,150,136,1)",
                        data: [28, 48, 40, 19, 26, 28, 48, 40, 19]
                    }
                ]
            };
            var ctxb2 = $("#barChartDemo2").get(0).getContext("2d");
            var barChart2 = new Chart(ctxb2).Bar(data2);
        </script>


    </body>

</html>
