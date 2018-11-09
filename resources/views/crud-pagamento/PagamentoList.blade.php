
@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')
    <style>
    .pagina{position: absolute;
        top:90px;
        left:300px;        
        width:760px;
        background-color: whitesmoke;
        padding: 4%;
        padding-top:20px;
        padding-bottom:100px;
    }
    .menu{
        
        
        background-color: whitesmoke;
        padding:10px;
    }
    .buttons_tools{
        position: relative;
        top:-30px;
        left:470px;
    }
    </style>
   
<div class="pagina">  
<div class="menu">
    <!--FILTER-->
   
        <form class="form-inline" id="form_busca" action="{{url('/pagamento/list')}}">
            <div class="form-group">            
                <label for="chave_CNPJ">CNPJ:</label><br/>
                <input type="text" id="chave_CNPJ" name="chave_CNPJ" class="form-control"  
                       value="{{$val_filters['chave_CNPJ'] or "" }}" >                 
            </div>
            
            <div class="form-group">  
                <label>Valor Minimo:</label><br/>
                <input type="text" id="chave_vlrMin" name="chave_vlrMin" size="16" name="chave_salMin" class="form-control"  
                    value="{{$val_filters['chave_vlrMin'] or "" }}" > 
            </div>
            
            <div class="form-group">
                <label>Valor Maximo:</label><br/>
                <input type="text" id="chave_vlrMax" size="16" name="chave_vlrMax" class="form-control"  
                    value="{{$val_filters['chave_vlrMax'] or "" }}" >
            </div>
            <div class="form-group">
                <label>Situação:</label><br/>
                <select name="chave_situacao" id="chave_situacao" class="form-control"  >
                    <option value="" @if(isset($val_filters['chave_situacao']) && $val_filters['chave_situacao']==''){{'selected'}}@endif ></option>
                    <option value="Aguardando" @if(isset($val_filters['chave_situacao']) && $val_filters['chave_situacao']=='Aguardando'){{'selected'}}@endif >Aguardando</option>
                    <option value="Efetuado" @if(isset($val_filters['chave_situacao']) && $val_filters['chave_situacao']=='Efetuado'){{'selected'}}@endif >Efetuado</option>
                    <option value="Estornado" @if(isset($val_filters['chave_situacao']) && $val_filters['chave_situacao']=='Estornado'){{'selected'}}@endif >Estornado</option>                
                </select>
            </div>
            
        </form>
    
<script type="text/javascript">
    $("#chave_CNPJ").on('change',function(){
        document.getElementById("form_busca").submit();
    });
    $("#chave_vlrMin").on('change',function(){
        document.getElementById("form_busca").submit();
    });
    $("#chave_vlrMax").on('change',function(){
        document.getElementById("form_busca").submit();
    });
    $("#chave_situacao").on('change',function(){
        document.getElementById("form_busca").submit();
    });
</script>
   
</div>
    
<!--LISTA DE Empresas-->

    <table class="table">
        <thead class="thead-inverse">
            <tr><th><h1>Pagamentos</h1></th></tr>
        </thead>
        <tbody>         
        @foreach($dadosPagsEmp as $pag)
        <tr>
            <th>
                <a href="{{url("pagamento/form/".$pag['pag_id'])}}" class="list-group-item" style="height:150px;width:620px;">  
                    <div style="position:relative;width:500px;">                        
                        <h4>{{$pag['emp_nome'] or ""}}</h4>  
                        <label>CNPJ: {{$pag['emp_CNPJ']}}</label><br/>        
                        <label>Valor: {{$pag['pag_valorTotal']}},00 R$</label>    
                         <label>Em Parcelas: {{$pag['pag_tipoPag']}}</label><br/> 
                         <label>Situacao: {{$pag['pag_situacao']}}</label><br/>
                    </div>                     
                    <a href="{{url("pagamento/form/".$pag['pag_id'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Editar</a> 
                    <a href="{{url("pagamento/delete/".$pag['pag_id'])}}" class="buttons_tools">
                        <span class="glyphicon glyphicon-trash" style="padding: 4px;" aria-hidden="true"></span>Inativar</a>                   
                </a>                
            </th>            
        </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endSection


