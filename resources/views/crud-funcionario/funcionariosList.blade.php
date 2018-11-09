
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
        width:760px;
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

    <script type='text/javascript'>
        function ex()
            {
            var x=confirm("Você quer mesmo sair desta página?");
            if (x)
             window.open("http://www.variedadesedicas.com");
            else
            alert("Você irá permanecer aqui!");
            } 
    </script>
    
<div class="menu">
    <!--FILTER-->
    <div class="dropdown">
        <form class="form-inline" id="form_busca" action="{{url('/funcionario/list')}}">
            <label>Filtros:</label><br/>
            <select name="campo_ent" class="form-control" >
                <option value="func_nome"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='func_name')
                        selected="selected"
                    @endif>Nome</option>
                <option value="func_CPF"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='func_cpf')
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
    
    <!--LISTA DE Funcionarios-->
    <table class="table">
        <thead class="thead-inverse">
            <tr><th><h1>Funcionarios</h1></th>
                <th>
                <a style="float:right;" href="{{url("funcionario/form/")}}" class="btn btn-primary" role="button">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true" style="margin-right:5px;"></span>Cadastrar
                </a>      
            </th></tr>
        </thead>
        <tbody>         
        @foreach($dadosFuncUser as $f)
        <tr>
            <th colspan="2">
                <a href="{{url("funcionario/show/".$f['func_cod'])}}" class="list-group-item" style="
                   @if($f['func_codUser']!=null)
                   height:150px;
                   @else
                   height:100px;
                   @endif
                   width:620px;
                   ">  
                    <img src="{{url('storage/app/public/imgperfil/')."/"}}{{$f['func_imagem'] or 'avatar.png'}}" style="width:51px;height:72px;" alt="perfil_foto">
                    <div style="position:relative;top:-92px;left:70px;width:500px;">                        
                        <h3>{{$f['func_nome']}}</h3>                         
                        <label>CPF: {{$f['func_CPF']}}</label><br/>
                        <label>Cargo: {{$f['func_cargo']}}</label><br/>
                         @if($f['func_codUser']!=null)
                            <label>Usuario: {{$f['func_username']}}</label><br/>
                            <label>Perfil Usuario: {{$f['func_userPerfil']}}</label><br/>
                         @endif               
                    </div> 

                    <a href="{{url("funcionario/form/".$f['func_cod'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Editar
                    </a> 
                    <a  class="buttons_tools"  href="{{url("funcionario/delete/".$f['func_cod'])}}">
                        <span class="glyphicon glyphicon-trash" style="padding: 4px;" aria-hidden="true"></span>Excluir</a>
                                         
                    @if($f['func_codUser']!=null)
                        <a href="{{url("usuario/formeditor/".$f['func_codUser'])}}" class="button_tools_user">
                            <span class="glyphicon glyphicon-user" style="padding:4px;" aria-hidden="true"></span>Usuario
                        </a>
                    @else
                        <a href="{{url("usuario/cadastro/func/".$f['func_cod'])}}" class="button_tools_user">
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

