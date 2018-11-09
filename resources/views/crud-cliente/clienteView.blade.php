
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
                <th rowspan="5">
                    <img src="{{url('storage/app/public/imgperfil/')."/"}}{{$dadosCliente['cliente_imagem'] or 'avatar.png'}}" 
                        alt="Imagem perfil" style="width:173px; height:240px;"/>
                </th>
                <th colspan="2">
                    <h4>CPF: {{$dadosCand['cliente_CPF']}}</h4>
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <h4>Data de Nasc.: {{$dadosCand['cliente_dataNasc']}}</h4>
                </th>
            </tr>
            
            <tr>
                <th>
                    <h4 colspan="2">Sexo: @if($dadosCliente['cliente_sexo']=='M') Masculino @else Feminino @endif</h4>
                </th>
            </tr>
            
             <tr>
                <th colspan="2">
                    <h4>E-mail: {{$dadosCand['cliente_email']}}</h4>
                </th>
            </tr>    
            
            <tr><th colspan="3"><h3>Enderenço:</h3></th></tr>
            
            <tr >
                <th colspan="2"><h4>{{$dadosCliente['cliente_end_logradouro']." ".$dadosCliente['cliente_end_rua']
                            .", Nº:".$dadosCliente['cliente_end_numero']}}</h4></th>
                <th><h4>Complemento:{{$dadosCliente['cliente_end_complemento']}}</h4></th>
            </tr>
            <tr>
                <th><h4>Estado:{{$dadosCliente['cliente_end_estado']}}</h4></th>
                <th><h4>Cidade:{{$dadosCliente['cliente_end_cidade']}}</h4></th>
                <th><h4>Bairro:{{$dadosCliente['cliente_end_bairro']}}</h4></th>
            </tr>
            
            <tr><th colspan="3"><h3>Contato:</h3></th></tr>
            <tr>
                <th><h4>Telefone:{{$dadosCliente['cliente_telefone']}}</h4></th>
                <th><h4>Celular:{{$dadosCliente['cliente_telefoneCel']}}</h4></th>                
            </tr>            
           
        </tbody>
            
        <thead>
            <tr ><th colspan="3" ><h1>{{$dadosCliente['cliente_nome']}}</h1></th></tr>
        </thead>
    
    </table>
    
    
</div>
@endsection
