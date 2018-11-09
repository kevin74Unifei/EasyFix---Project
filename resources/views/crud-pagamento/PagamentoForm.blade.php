
@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')



<style>
    
    .pagina{position: absolute;
        top:100px;
        left:15%;        
        width:1050en;
        background-color: whitesmoke;
        padding: 4%;
        padding-bottom:100px;
    }

    .info_pessoal{position:relative;
        float:right;
    }
    .img_perfil{
        padding-left: 4%;
        float:left;
    }
    
    .form-group{
        padding-left: 11px;
        padding-top: 10px;
    }     
    
    .buttons{position: relative;  
        top:30px;
        left:10px;
    }      
</style>

<div class="pagina">
    @if(isset($errors) && count($errors)>0)
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
        <p>{{$error}}</p>
        @endforeach
    </div>
    @endif
    <form class="form-inline" method='post' enctype="multipart/form-data" action='
            @if(isset($resp))
                {{url('pagamento/edit/'.$resp['pag_id'])}}    
            @else
                {{url('pagamento/cadastrar')}}
            @endif
            '>
            
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        <fieldset>
            <legend>Informações Sobre Pagamento:</legend> 

            <div class="form-group" style="width:100%;">
                    <label for="pag_empresa">Empresa:</label><br/>
                    <select  class="form-control" name="pag_empresa_cod"
                         style="width:100%;"  required="required" {{$enabledEdition['Empresa'] or ''}}>
                        @foreach($dadosEmpresas as $empresaDados)
                         <option value="{{$empresaDados['emp_cod'] or ""}}">{{$empresaDados['emp_CNPJ']." - ".$empresaDados['emp_nome']}}</option>
                        @endforeach
                        </select>
            </div><br/>
      
            @include('../templates/components/fieldTipoPagamento')
            
            <div class="form-group">
                <label for="{{$ent or "ent"}}_valorPag">Valor:</label><br/>
                <input type="number" size="6" class="form-control" id="valor_pagamento"
                       value="{{$resp["pag_valorPag"] or ""}}" required="required" name="{{$ent or "ent"}}_valorPag" 
                       placeholder="Valor Unitario">
            </div>
            
            <div class="form-group">
                <label for="{{$ent or "ent"}}_desconto">Desconto:</label><br/>
                <input type="number"  class="form-control" min='0' max='30' id="valor_desc"
                       value="{{$resp["pag_desconto"] or ""}}" required="required" name="{{$ent or "ent"}}_desconto" 
                       placeholder="Porcentagem"> %
            </div><br/>
            
            <div class="form-group" style="float:right">
                <label for="pag_valorTotal">Valor Total:</label><br/>
                <input type="number" size="6" class="form-control" id="previewValorTotal" 
                       value="0.00" placeholder="Valor Total" disabled/> 
                <script type="text/javascript">
                    $('#valor_desc').on("change",function(){
                        calculaValorTotal();
                    });
                    $('#valor_pagamento').on("change",function(){
                        calculaValorTotal();
                    });
                    
                    function calculaValorTotal(){
                        var valorPag = $('#valor_pagamento').val();
                        var valorDesc = $('#valor_desc').val();
                        
                        $("#previewValorTotal").val(valorPag-(valorPag*(valorDesc/100)));
                    }
                </script> 
            </div>     
            @if(isset($resp))
            @include('../templates/components/fieldSituacaoPagamento')@endif
            @include('../templates/form/areaBotao')
            
            
            </fieldset>
        </div>
        @endsection

                
                       
            
            
            
            
            
                
            