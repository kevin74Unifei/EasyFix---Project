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

        .imagem_list {
            width: 200px;
            height: 200px;
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
            <form class="form-inline" id="form_busca" action="{{url('/album/list')}}">
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
                <th><h1>Imagens:</h1></th>
                <th>
                    <a style="float:right;" href="{{url("album/form/")}}" class="btn btn-primary" role="button">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true" style="margin-right:5px;"></span>Cadastrar
                    </a>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($dadosAlbumArray as $a)

                <div class="row">
                    <div class="col-md-6">
                        <img src="{{url('storage/app/album/'.$a['path'])}}"
                             class="imagem_list">
                    </div>

                    <div class="col-md-6">
                        <a class="btn btn-danger" href="{{url('album/delete/'.$a['album_id'])}}">
                            <i class="glyphicon glyphicon-remove"></i>
                        </a>
                    </div>
                </div>
                <br/>

            @endforeach
            </tbody>
        </table>
    </div>
@endSection

