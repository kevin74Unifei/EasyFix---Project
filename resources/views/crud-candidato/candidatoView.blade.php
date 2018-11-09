
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
                    <img src="{{url('storage/app/public/imgperfil/')."/"}}{{$dadosCand['cand_imagem'] or 'avatar.png'}}" 
                        alt="Imagem perfil" style="width:173px; height:240px;"/>
                </th>
                <th colspan="2">
                    <h4>CPF: {{$dadosCand['cand_CPF']}}</h4>
                </th>
            </tr>
            <tr>
                <th colspan="2">
                    <h4>Data de Nasc.: {{$dadosCand['cand_dataNasc']}}</h4>
                </th>
            </tr>
            
            <tr>
                <th>
                    <h4 colspan="2">Sexo: @if($dadosCand['cand_sexo']=='M') Masculino @else Feminino @endif</h4>
                </th>
            </tr>
            
             <tr>
                <th colspan="2">
                    <h4>E-mail: {{$dadosCand['cand_email']}}</h4>
                </th>
            </tr>    
            
            <tr><th colspan="3"><h3>Enderenço:</h3></th></tr>
            
            <tr >
                <th colspan="2"><h4>{{$dadosCand['cand_end_logradouro']." ".$dadosCand['cand_end_rua']
                            .", Nº:".$dadosCand['cand_end_numero']}}</h4></th>
                <th><h4>Complemento:{{$dadosCand['cand_end_complemento']}}</h4></th>
            </tr>
            <tr>
                <th><h4>Estado:{{$dadosCand['cand_end_estado']}}</h4></th>
                <th><h4>Cidade:{{$dadosCand['cand_end_cidade']}}</h4></th>
                <th><h4>Bairro:{{$dadosCand['cand_end_bairro']}}</h4></th>
            </tr>
            
            <tr><th colspan="3"><h3>Contato:</h3></th></tr>
            <tr>
                <th><h4>Telefone:{{$dadosCand['cand_telefone']}}</h4></th>
                <th><h4>Celular:{{$dadosCand['cand_telefoneCel']}}</h4></th>                
            </tr>            
           
        </tbody>
            
        <thead>
            <tr ><th colspan="3" ><h1>{{$dadosCand['cand_nome']}}</h1></th></tr>
        </thead>
    
    </table>
    
    
</div>
@endsection
