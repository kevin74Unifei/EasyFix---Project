
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
        <form class="form-inline" id="form_busca" action="{{url('/empresa/list')}}">
            <label>Filtros:</label><br/>
            <select name="campo_ent" class="form-control" >
                <option value="emp_nome"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='emp_nome')
                        selected="selected"
                    @endif>Nome</option>
                <option value="emp_end_cidade"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='emp_end_cidade')
                        selected="selected"
                    @endif>Cidade</option>
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
    
<!--LISTA DE Empresas-->
<div class="pagina">
    <table class="table">
        <thead class="thead-inverse">
            <tr><th><h1>Empresas</h1></th></tr>
        </thead>
        <tbody>         
        @foreach($dadosEmp as $f)
        <tr>
            <th>
                <a href="{{url("empresa/show/".$f['emp_cod'])}}" class="list-group-item" style="height:100px;width:620px;">  
                    <div style="position:relative;top:-10px;left:70px;width:500px;">                        
                        <h3>{{$f['emp_nome']}}</h3>                         
                        <label>Cidade: {{$f['emp_end_cidade']}}</label><br/>                  
                    </div>  
                    
                    <a href="{{url("empresa/form/".$f['emp_cod'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Editar</a> 
                    <a href="{{url("empresa/delete/".$f['emp_cod'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-trash" style="padding: 4px;" aria-hidden="true"></span>Inativar</a>
                        
                         
                    
                        <a href="{{url("vaga/form/".$f['emp_cod'])}}" class="button_tools_user">
                            <span class="glyphicon glyphicon-user" style="padding:4px;" aria-hidden="true"></span>Cadastro de Vagas
                        </a>
                        <a href="{{url("vaga/list?campo_ent=vag_nomeEmpresa&chave_busca=".$f['emp_nome'])}}" class="button_tools_user">
                            <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Visualizar Vagas
                        </a>
                   
                </a>                
            </th>            
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endSection


