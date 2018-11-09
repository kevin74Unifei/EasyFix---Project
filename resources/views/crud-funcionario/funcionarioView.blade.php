
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
                    <img src="{{url('storage/app/public/imgperfil/')."/"}}{{$dadosFunc['func_imagem'] or 'avatar.png'}}" 
                        alt="Imagem perfil" style="width:173px; height:240px;"/>
                </th>
                <th>
                    <h4>CPF: {{$dadosFunc['func_CPF']}}</h4>
                </th>
                
                <th>
                    <h4>RG: {{$dadosFunc['func_RG']}}</h4>
                </th>                
            </tr>
            <tr>
                <th>
                    <h4>Nº Cart. Trab.: {{$dadosFunc['func_cartTrab']}}</h4>
                </th>
            </tr>
            
            <tr>
                <th>
                    <h4>Data de Nasc.: {{$dadosFunc['func_dataNasc']}}</h4>
                </th>
                
                <th>
                    <h4>Sexo: @if($dadosFunc['func_sexo']=='M') Masculino @else Feminino @endif</h4>
                </th>               
            </tr>
            <tr>
                <th>
                    <h4>Cargo: {{$dadosFunc['func_cargo']}}</h4>
                </th>
                
                <th>
                    <h4>Carga Horaria: {{$dadosFunc['func_cargaHor']}} Hr/dia</h4>
                </th> 
            </tr>
            
             <tr>
                <th colspan="2">
                    <h4>E-mail: {{$dadosFunc['func_email']}}</h4>
                </th>
            </tr>    
            <tr><th colspan="3"><h3>Usuario do Sistema:</h3></th></tr>
            
            <tr><th colspan="3"><h3>Enderenço:</h3></th></tr>
            
            <tr >
                <th colspan="2"><h4>{{$dadosFunc['func_end_logradouro']." ".$dadosFunc['func_end_rua']
                            .", Nº:".$dadosFunc['func_end_numero']}}</h4></th>
                <th><h4>Complemento:{{$dadosFunc['func_end_complemento']}}</h4></th>
            </tr>
            <tr>
                <th><h4>Estado:{{$dadosFunc['func_end_estado']}}</h4></th>
                <th><h4>Cidade:{{$dadosFunc['func_end_cidade']}}</h4></th>
                <th><h4>Bairro:{{$dadosFunc['func_end_bairro']}}</h4></th>
            </tr>
            
            <tr><th colspan="3"><h3>Contato:</h3></th></tr>
            <tr>
                <th><h4>Telefone:{{$dadosFunc['func_telefone']}}</h4></th>
                <th><h4>Celular:{{$dadosFunc['func_telefoneCel']}}</h4></th>                
            </tr>   
        </tbody>
            
        <thead>
            <tr ><th colspan="3" ><h1>{{$dadosFunc['func_nome']}}</h1></th></tr>
        </thead>
    
    </table>
    
    
</div>
@endsection

