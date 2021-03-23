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
        <title>@yield('title') - Sistema Funerário</title>
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
        @include('templates.header2')

        <!-- Main Content -->
        <main class="app-content" style="margin-left:0px">        
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
        <script type="text/javascript" src="{{ url('assets/js/plugins/mask.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/plugins/maskmoney.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/main.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/plugins/bootstrap-notify.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/plugins/pace.min.js') }}"></script>
        <script type="text/javascript" src="{{ url('assets/js/script.js' )}}"></script>         
        
    </body>
</html>
