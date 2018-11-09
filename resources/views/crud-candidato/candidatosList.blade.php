
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
        width:750en;
        background-color: whitesmoke;
        padding: 4%;
        padding-top:20px;
        padding-bottom:100px;
    }
    .menu{
        position:fixed;
        top:80px;
        width:300px;
        height:100%;
        background-color: whitesmoke;
        padding:10px;
    }
    .buttons_tools{
        position: relative;
        top:-30px;
        left:470px;
    }
    
    .button_tools_user{
        position: relative;
        top:-30px;
        left:250px;
    }
    </style>
    
    </style>
   
    
<div class="menu">
    <!--FILTER-->
    <div class="dropdown">
        <form class="form-inline" id="form_busca" action="{{url('/candidato/list')}}">
            <label>Filtros:</label><br/>
            <select name="campo_ent" class="form-control" >
                <option value="cand_nome"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='cand_name')
                        selected="selected"
                    @endif>Nome</option>
                <option value="cand_cpf"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='cand_cpf')
                        selected="selected"
                    @endif>CPF</option>
            </select>
            <input type="text" id="chave_busca" name="chave_busca" class="form-control"  
                value="{{$valor_filter_text or ""}}" >                 
        </form>
    </div>
<script type="text/javascript">
    $("#chave_busca").on('change',function(){
        document.getElementById("form_busca").submit();
    });
</script>
   
</div>
    

<div class="pagina">    
    
    <!--LISTA DE Candidatos-->
    <table class="table">
        <thead class="thead-inverse">
            <tr><th><h1>Candidatos</h1></th>
                <th>
                <a style="float:right;" href="{{url("candidato/form/")}}" class="btn btn-primary" role="button">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true" style="margin-right:5px;"></span>Cadastrar
                </a>      
            </th></tr>
        </thead>
        <tbody>         
        @foreach($dadosCandUser as $f)
        <tr>
            <th colspan="2">
                <a href="{{url("candidato/show/".$f['cand_cod'])}}" class="list-group-item" style="height:100px;width:620px;">  
                    <img src="{{url('storage/app/public/imgperfil/')."/"}}{{$f['cand_imagem'] or 'avatar.png'}}" style="width:51px;height:72px;" alt="perfil_foto">
                    <div style="position:relative;top:-92px;left:70px;width:500px;">                        
                        <h3>{{$f['cand_nome']}}</h3>                         
                        <label>CPF: {{$f['cand_CPF']}}</label><br/>
                         @if($f['cand_codUser']!=null)
                            <label>Usuario: {{$f['cand_username']}}</label><br/>                            
                         @endif                  
                    </div>  
                    <!--Botões de edição e exclusão-->
                    <a href="{{url("candidato/form/".$f['cand_cod'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Editar</a> 
                    <a href="{{url("candidato/delete/".$f['cand_cod'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-trash" style="padding: 4px;" aria-hidden="true"></span>Excluir</a>
                    <!--Botão de edição de usuario, se tiver opção de editar, se não opção de criar-->
                    @if($f['cand_codUser']!=null)
                        <a href="{{url("usuario/formeditor/".$f['cand_codUser'])}}" class="button_tools_user">
                            <span class="glyphicon glyphicon-user" style="padding:4px;" aria-hidden="true"></span>Usuario
                        </a>
                    @else
                        <a href="{{url("usuario/cadastro/cand/".$f['cand_cod'])}}" class="button_tools_user">
                            <span class="glyphicon glyphicon-plus" style="padding:4px;" aria-hidden="true"></span>Usuario
                        </a>
                    @endif
                </a>                
            </th>            
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endSection

