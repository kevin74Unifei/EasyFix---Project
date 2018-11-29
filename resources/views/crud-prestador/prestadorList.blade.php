@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')
    <style>
        .pagina {
            position: absolute;
            top: 80px;
            left: 350px;
            width: 750 en;
            background-color: whitesmoke;
            padding: 4%;
            padding-top: 20px;
            padding-bottom: 100px;
        }

        .menu {
            position: fixed;
            top: 80px;
            width: 300px;
            height: 100%;
            background-color: whitesmoke;
            padding: 10px;
        }

        .buttons_tools {
            position: relative;
            top: -30px;
            left: 470px;
        }

        .button_tools_user {
            position: relative;
            top: -30px;
            left: 250px;
        }
    </style>


    <div class="menu">

        <div class="dropdown">
            <form class="form-inline" id="form_busca" action="{{url('/prestador/list')}}">
                <label>Filtros:</label><br/>
                {{--<select name="campo_ent" class="form-control">
                    <option value="cliente_nome"
                            @if(isset($valor_filter_campo) && $valor_filter_campo=='prestador_nome')
                            selected="selected"
                            @endif>Nome
                    </option>
                    <option value="cliente_cpf"
                            @if(isset($valor_filter_campo) && $valor_filter_campo=='cliente_cpf')
                            selected="selected"
                            @endif>CPF
                    </option>
                </select>--}}
                <input type="text" id="chave_busca" name="chave_busca" class="form-control"
                       value="{{$valor_filter_text or ""}}">
            </form>
        </div>
        <script type="text/javascript">
            $("#chave_busca").on('change', function () {
                document.getElementById("form_busca").submit();
            });
        </script>

    </div>


    <div class="pagina">

        <!--LISTA DE Clientes-->
        <table class="table">
            <thead class="thead-inverse">
            <tr>
                <th><h1>Prestadores</h1></th>
                <th>
                    <a style="float:right;" href="{{url("prestador/form/")}}" class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true" style="margin-right:5px;"></span>Cadastrar
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($dadosPrestadorArray as $f)

                <tr>
                    <th colspan="2">
                        <a href="{{url("prestador/show/".$f['prestador_id'])}}" class="list-group-item"
                           style="height:100px;width:620px;">
                            <div style="">
                                <h3>{{$f['prestador_nome']}}</h3>
                                <label>Representacao: {{$f['prestador_representacao']}}</label><br/>
                            </div>
                            <!--Botões de edição e exclusão-->
                            <a href="{{url("prestador/form/".$f['prestador_id'])}}" class="buttons_tools">
                                <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Editar</a>
                            <a href="{{url("prestador/delete/".$f['prestador_id'])}}" class="buttons_tools">
                                <span class="glyphicon glyphicon-trash" style="padding: 4px;" aria-hidden="true"></span>Excluir</a>
                            <!--Botão de edição de usuario, se tiver opção de editar, se não opção de criar-->
                            {{--@if($f['cliente_codUser']!=null)
                                <a href="{{url("usuario/formeditor/".$f['cliente_codUser'])}}"
                                   class="button_tools_user">
                                    <span class="glyphicon glyphicon-user" style="padding:4px;"
                                          aria-hidden="true"></span>Usuario
                                </a>
                            @else
                                <a href="{{url("usuario/cadastro/cliente/".$f['cliente_cod'])}}"
                                   class="button_tools_user">
                                    <span class="glyphicon glyphicon-plus" style="padding:4px;"
                                          aria-hidden="true"></span>Usuario
                                </a>
                            @endif--}}
                        </a>
                    </th>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endSection

