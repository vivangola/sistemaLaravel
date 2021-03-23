<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css"
        href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - Sistema Funerário</title>
</head>
<body>
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>
    <section class="login-content">
        <div class="logo">
            <h1></h1>
        </div>
        <div class="login-box" style="min-height: 350px;"> 
            <form class="login-form" method="post" action="{{ url('/pagamentos') }}">
                @csrf
                <h3 class="login-head">Consultar Mensalidades</h3>
                    @if($errors->first())
                        <div class="text-center alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif
                <div class="form-group">
                    <label class="control-label">CPF do Titular</label>
                    <input class="form-control cpf" type="text" name="cpf" placeholder="CPF do Titular" autofocus required>
                </div>
                <div class="form-group btn-container">
                    <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Acessar</button>
                </div>
            </form>
            <form class="forget-form" method="post" action="resetarSenha">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Esqueci minha senha</h3>
                <div class="form-group">
                    <label class="control-label">EMAIL</label>
                    <input class="form-control" type="text" placeholder="Email">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-unlock fa-lg fa-fw"></i>Enviar</button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Voltar ao Login</a></p>
                </div>
            </form>
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="assets/js/jquery-3.3.1.min.js"></script>
    <script src="assets/js/plugins/mask.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript">
    // Login Page Flipbox control
    $('.login-content [data-toggle="flip"]').click(function() {
        $('.login-box').toggleClass('flipped');
        return false;
    });
    </script>
</body>

</html>