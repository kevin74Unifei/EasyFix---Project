<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>{{$title or "EasyFix"}}</title>

    <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css"
          rel="stylesheet">
    <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
    <script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
    <link rel="stylesheet" href="{{url('bootstrap/css/bootstrap.min.css')}}" crossorigin="anonymous">
    <script src="{{url('bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{url('bootstrap/js/bootstrap.js')}}"></script>
    <link rel="stylesheet" href="{{url('css/stylesidebar.css')}}" crossorigin="anonymous">

    <style>
        body {
            padding: 0px;
            margin: 0px;
            background-color: #bbbbd6;
        }

        .navbar-per1 {
            font-family: Serif;
            font-size: 30px;
            padding-top: 10px;
            padding-left: 25%;
            color: whitesmoke;
        }
    </style>

</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            @if(isset(Auth::user()->username))
                <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                    <span class="hamb-top"></span>
                    <span class="hamb-middle"></span>
                    <span class="hamb-bottom"></span>
                </button>
            @endif
            @yield('tools-icon')


            <b><p class="navbar-per1">EasyFix</p></b>
        </div>

        @if(isset(Auth::user()->username))
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">
                            <img style="width:17px;height:24px;"
                                 src="{{url('storage/app/public/imgperfil/')."/"}}@if(isset(Auth::user()->user_imagem)){{Auth::user()->user_imagem}} @else{{'avatar.png'}}@endif"
                                 alt="usuario_imagem"/>

                            {{Auth::user()->username}} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="
                                      @if(Auth::user()->user_perfil=='Administrador' || Auth::user()->user_perfil=='Atendente')
                                {{url('funcionario/form/')."/".Auth::user()->user_vinculo}}
                                @else
                                {{url('cliente/form/')."/".Auth::user()->user_vinculo}}
                                @endif
                                        ">Editar Perfil</a></li>
                            <li><a href="{{url('usuario/formeditor/').'/'.Auth::user()->id}}">Editar Login</a></li>
                            <li><a href="{{url("/logout")}}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>

<script type='text/javascript'>
    //Funcionamento do botão do menu
    $(document).ready(function () {
        var trigger = $('.hamburger'),
            overlay = $('.overlay'),
            isClosed = false;

        trigger.click(function () {
            hamburger_cross();
        });

        function hamburger_cross() {

            if (isClosed == true) {
                overlay.hide();
                trigger.removeClass('is-open');
                trigger.addClass('is-closed');
                isClosed = false;
            } else {
                overlay.show();
                trigger.removeClass('is-closed');
                trigger.addClass('is-open');
                isClosed = true;
            }
        }

        $('[data-toggle="offcanvas"]').click(function () {
            $('#wrapper').toggleClass('toggled');
        });
    });

    $(document).ready(function () {
//Chama o evento após selecionar um valor
        if ($prestOff) {
            if ($prestOff == true) {
                $("#prefilPrestador").hide();
            }
        }
    });
</script>
<div id="wrapper" class='wrapper'><!--Menu de opçãoes-->
    @if(isset(Auth::user()->username))
        <div class="overlay"></div>
        <!-- Sidebar -->
        <nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand">
                    <a href="#">
                        Brand
                    </a>
                </li>
                <li class="sidebar-brand">
                    <a href="{{url('/home')}}">
                        Home
                    </a>
                </li>
                @if(Auth::user()->user_perfil=='Cliente')

                    <li><a href="{{url('prestador/form')}}">Solicitar perfil profissional</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cliente<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('cliente/list')}}">Listar Clientes</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Serviços <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('servico/form')}}">Cadastrar Serviço</a></li>
                            <li><a href="{{url('servico/list')}}">Listar Serviço</a></li>

                        </ul>
                    </li>
                @endif
                @if(Auth::user()->user_perfil=='Administrador')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Cliente<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('cliente/form')}}">Cadastrar Clientes</a></li>
                            <li><a href="{{url('cliente/list')}}">Listar Clientes</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Funcionários <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('funcionario/form')}}">Cadastrar Funcionario</a></li>
                            <li><a href="{{url('funcionario/list')}}">Listar Funcionario</a></li>

                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Serviços <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('servico/form')}}">Cadastrar Serviço</a></li>
                            <li><a href="{{url('servico/list')}}">Listar Serviço</a></li>

                        </ul>
                    </li>
                <!--
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Empresas Parceiras <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('empresa/form')}}">Cadastrar Empresa</a></li>
                            <li><a href="{{url('empresa/list')}}">Listar Empresas</a></li>
                          </ul>
                        </li>

                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Vagas Disponiveis <span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('vaga/form')}}">Cadastrar Vagas</a></li>
                            <li><a href="{{url('vaga/list')}}">Listar Vagas</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Pagamentos<span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('pagamento/form')}}">Cadastrar Pagamento</a></li>
                            <li><a href="{{url('pagamento/list')}}">Listar Pagamentos</a></li>
                          </ul>
                        </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Entrevistas<span class="caret"></span></a>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="{{url('entrevista/form')}}">Cadastrar Entrevista</a></li>
                            <li><a href="{{url('entrevista/list')}}">Listar Entrevistas</a></li>
                          </ul>
                        </li>
                @endif
                @if(Auth::user()->user_perfil=='Administrador')
                <li>
                    <a href="{{url('/rel')}}">Emitir Rel. de Vagas</a>
                    </li>
                    -->
                @endif
                <li>
                    <a href="http://www.google.com">Ajuda</a>
                </li>
                @yield('Menu')
            </ul>
        </nav>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container">

            </div>
        </div>
    @endif
</div>
@yield('Base')

</body>
</html>

