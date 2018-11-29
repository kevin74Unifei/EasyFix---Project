@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')

    <script>
        $(document).ready(function () {
//Chama o evento após selecionar um valor
            $('#fieldRepresentacao').on('change', function () {
//Verifica se o valor é igual a 1 e mostra a divCnpj
                if (this.value == '0') {
                    $("#divmei").hide();
                    $("#divcnpj").show();
                }
//Se o tempo for mé igual a 2 mostra a divCpf
                else if (this.value == '1') {
                    $("#divcnpj").hide();
                    $("#divmei").show();
                }
//Se não for nem 1 nem 2 esconde as duas
                else {
                    $("#divcnpj").hide();
                    $("#divmei").hide();
                }
            });
        });
    </script>

    <style>

        .pagina {
            position: absolute;
            top: 100px;
            left: 15%;
            width: 1050 en;
            background-color: whitesmoke;
            padding: 4%;
            padding-bottom: 100px;
        }

        .info_pessoal {
            position: relative;
            float: right;
        }

        .img_perfil {
            padding-left: 4%;
            float: left;
        }

        .form-group {
            padding-left: 11px;
            padding-top: 10px;
        }

        .buttons {
            position: relative;
            top: 30px;
            left: 10px;
        }
    </style>

    <div class="pagina">
        @if(isset($errors) && count($errors)>0)
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <p>{{$error}}</p>
                @endforeach
            </div>
        @endif
        <form class="form-inline" method='post' enctype="multipart/form-data" action='
            @if(isset($resp))
        {{url('prestador/edit/'.$resp['cod'])}}
        @else
        {{url('prestador/cadastrar')}}
        @endif
                '>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="prestador_nome" value="{{$prestador_nome}}">
            <input type="hidden" name="prestador_perfil" value="Prestador">
            <fieldset>
                <legend>Informações de serviço:</legend>

                <div class="info_pessoal">

                    <div class="form-group">
                        <label>Representação Jurídica:</label><br/>
                        <select class="form-control" id="fieldRepresentacao" required="required"
                                name="{{$ent or "ent"}}_representacao"
                        {{$enabledEdition['prestador_representacao'] or ""}}">
                        <option value="0">CNPJ</option>
                        <option value="1">MEI</option>
                        </select>
                    </div>
                    <br/>
                    <div id="divcnpj">
                        @include('../templates/components/fieldCNPJ')
                    </div>
                    <div id="divmei" hidden="hidden">
                        @include('../templates/components/fieldMEI')
                    </div>

                    <div class="form-group">
                        <label for="prestador_tipo">Profissão:</label><br/>
                        <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_tipo"
                               value="{{$resp['prestador_tipo'] or ""}}"
                               onkeyup="this.value = this.value.toUpperCase();" {{$enabledEdition['prestador_tipo'] or ""}}>
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="prestador_descricao">
                            Descrição:
                        </label><br/>
                        <textarea class="form-control" id="prestador_descricao" required="required"
                                  name="{{$ent or "ent"}}_descricao" {{$enabledEdition['prestador_descricao'] or ""}}></textarea>
                    </div>

                </div>
            </fieldset>
            @include('../templates/form/areaBotao')
            <br/>
    </div>
@endsection