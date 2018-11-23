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
        <form class="form-inline" id="form_busca" action="{{url('/servico/list')}}">
            <label>Filtros:</label><br/>
            <select name="campo_tipo_prof" class="form-control" id='chave_busca' >
                <option value="Todos"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='ent_entrevistado')
                        selected="selected"
                    @endif>Todos</option> 
                <option value="Pedreiro"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='Pedreiro')
                        selected="selected"
                    @endif>Pedreiro</option>          
                <option value="Pintor"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='Pintor')
                        selected="selected"
                    @endif>Pintor</option>
                <option value="Mecânico"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='Mecânico')
                        selected="selected"
                    @endif>Mecânico</option>
                <option value="Eletricista"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='Eletricista')
                        selected="selected"
                    @endif>Eletricista</option>
                <option value="Técnico"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='Técnico')
                        selected="selected"
                    @endif>Técnico</option>
                <option value="Entre outros"
                    @if(isset($valor_filter_campo) && $valor_filter_campo=='Entre outros')
                        selected="selected"
                    @endif>Entre outros</option>                
            </select>
             
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
            <tr><th><h1>Serviços em aguardo</h1></th></tr>
        </thead>
        <tbody>         
        @foreach($dadosEnt as $f)
        <tr>
            <th>
                <a href="{{url("servico/show/".$f['ent_cod'])}}" class="list-group-item" style="height:100px;width:660px;">  
                    <div style="position:relative;top:-10px;left:10px;width:600px;">                        
                        <h3>{{$f['ent_entrevistado']}}</h3>                         
                        <label>Tipo do Serviço: {{$f['ent_tipo_prof']}}</label><br/>
                        <p>Disponivel em: {{$f['ent_data_inicial']}} até {{$f['ent_data_final']}}</p>
                    </div>  
                    
                    <a href="{{url("servico/form/".$f['ent_cod'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Editar</a> 
                    <a href="{{url("servico/delete/".$f['ent_cod'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-trash" style="padding: 4px;" aria-hidden="true"></span>Cancelar</a>                 
                </a>                
            </th>            
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endSection
