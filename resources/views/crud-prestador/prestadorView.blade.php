
@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')
    <style>
        .pagina{position: absolute;
            top:80px;
            left:350px;
            width:1050en;
            background-color: whitesmoke;
            padding: 4%;
            padding-top:20px;
            padding-bottom:100px;
        }

    </style>

    <div class="pagina">
        <table class="table">
            <tbody>
            <tr>
                <th colspan="2">
                    <h4>Tipo: {{$dadosprestador['prestador_tipo']}}</h4>
                </th>
            </tr>

            <tr>
                <th>
                    <h4 colspan="2">Representação: {{$dadosprestador['cliente_sexo']}}</h4>
                </th>
            </tr>

            <tr>
                <th colspan="2">
                    <h4>Descricao: {{$dadosprestador['prestador_descricao']}}</h4>
                </th>
            </tr>

            </tbody>

            <thead>
            <tr ><th colspan="3" ><h1>{{$dadosprestador['cliente_nome']}}</h1></th></tr>
            </thead>

        </table>


    </div>
@endsection
