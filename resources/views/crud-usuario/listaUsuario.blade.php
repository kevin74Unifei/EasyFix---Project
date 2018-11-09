
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
    </style>
   
    
<div class="menu">
    <!--FILTER-->
    <div class="dropdown">
        <form class="form-inline" id="form_busca" action="{{url('/usuario/list')}}">
            <label>Filtros:</label><br/>
            <select name="campo_ent" class="form-control" >
                <option value="user_login"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='user_login')
                        selected="selected"
                    @endif>Login</option>
                <option value="user_perfil"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='user_perfil')
                        selected="selected"
                    @endif>Perfil</option>
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
    
<!--LISTA DE FUNCIONARIOS-->
<div class="pagina">
    <table class="table">
        <thead class="thead-inverse">
            <tr><th><h1>Usuários</h1></th></tr>
        </thead>
        <tbody>         
        @foreach($dadosUser as $f)
        <tr>
            <th>
                <a href="#" class="list-group-item" style="height:100px;width:620px;">  
                    <img src="{{url('storage/imgperfil/avatar.png')}}" style="width:51px;height:72px;" alt="perfil_foto">
                    <div style="position:relative;top:-92px;left:70px;width:500px;">                        
                        <h3>{{$f['username']}}</h3>                         
                        <label>Perfil: {{$f['user_perfil']}}</label><br/>                  
                    </div>  
                    
                    <a href="{{url("usuario/formeditor/".$f['id'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Editar</a> 
                    <a href="{{url("usuario/delete/".$f['id'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-trash" style="padding: 4px;" aria-hidden="true"></span>Excluir</a>
                    
                </a>                
            </th>            
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endSection


