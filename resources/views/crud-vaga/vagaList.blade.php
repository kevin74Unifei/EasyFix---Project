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
        <form class="form-inline" id="form_busca" action="{{url('/vaga/list')}}">
            <label>Filtros:</label><br/>
            <select name="campo_ent" class="form-control" >
                <option value="vag_nome"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='vag_nome')
                        selected="selected"
                    @endif>Nome</option>
                <option value="vag_estado"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='vag_estado')
                        selected="selected"
                    @endif>Estado da vaga</option>
                
                <option value="vag_nomeEmpresa"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='vag_nomeEmpresa')
                        selected="selected"
                    @endif>Empresa</option>
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
    
<!--LISTA DE Vagas-->
<div class="pagina">
    <table class="table">
        <thead class="thead-inverse">
            <tr><th><h1>Vagas</h1></th></tr>
        </thead>
        <tbody>         
        @foreach($dadosVag as $f)
        <tr>
            <th>
                <a href="{{url("vaga/show/".$f['vag_id'])}}" class="list-group-item" style="height:100px;width:620px;">  
                    <div style="position:relative;top:-10px;left:70px;width:500px;">                        
                        <h3>{{$f['vag_nome']}}</h3>                         
                        <label>Estado da vaga: {{$f['vag_estado']}}</label><br/> 
                        <label>Empresa: {{$f['vag_nomeEmpresa']}}</label><br/> 
                    </div>  
                    
                    <a href="{{url("vaga/show/".$f['vag_id'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Editar</a> 
                    <a href="{{url("vaga/delete/".$f['vag_id'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-trash" style="padding: 4px;" aria-hidden="true"></span>Inativar</a>
                </a>                
            </th>            
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endSection
