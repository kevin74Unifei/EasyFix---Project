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
        <form class="form-inline" id="form_busca" action="{{url('/entrevista/list')}}">
            <label>Filtros:</label><br/>
            <select name="campo_ent" class="form-control" >
                <option value="ent_entrevistado"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='ent_entrevistado')
                        selected="selected"
                    @endif>Entrevistado</option>
                <option value="ent_empresa"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='ent_empresa')
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
    
<!--LISTA DE Empresas-->
<div class="pagina">
    <table class="table">
        <thead class="thead-inverse">
            <tr><th><h1>Entrevistas</h1></th></tr>
        </thead>
        <tbody>         
        @foreach($dadosEnt as $f)
        <tr>
            <th>
                <a href="{{url("entrevista/show/".$f['ent_cod'])}}" class="list-group-item" style="height:100px;width:620px;">  
                    <div style="position:relative;top:-10px;left:70px;width:500px;">                        
                        <h3>{{$f['ent_entrevistado']}}</h3>                         
                        <label>Empresa: {{$f['ent_empresa']}}</label><br/>                  
                    </div>  
                    
                    <a href="{{url("entrevista/form/".$f['ent_cod'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Editar</a> 
                    <a href="{{url("entrevista/delete/".$f['ent_cod'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-trash" style="padding: 4px;" aria-hidden="true"></span>Cancelar</a>                 
                </a>                
            </th>            
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endSection
