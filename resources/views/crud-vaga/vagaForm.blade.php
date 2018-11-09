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
            right: 15%;
            width:1050en;
            background-color: whitesmoke;
            padding: 4%;
            padding-bottom:100px;
    }

    .info_pessoal{position:relative;
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
<script type="text/javascript">    
    
$(function(){
$("#vag_valorPag").mask("R$000000,00");
});
</script>

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
          {{url('vaga/edit/'.$resp['id'])}}    
          @else
          {{url('vaga/cadastrar')}}
          @endif
          '>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <fieldset>
            <legend>Informações da vaga:</legend>            
            <div class="info_pessoal">
                @include('../templates/components/fieldName') 
                <br/>
                
                <div class="form-group">
                    <label for="vag_escolar">Escolaridade:</label><br/>
                    <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_escolar"
                           value="{{$resp['escolar'] or ""}}"  required="required" {{$enabledEdition['escolar'] or ""}}>
                </div>
                
                <div class="form-group">
                    <label for="vag_idioma">Idioma:</label><br/>
                    <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_idioma"
                           value="{{$resp['idioma'] or ""}}" required="required" {{$enabledEdition['idioma'] or ""}}>
                </div>
                <br/>
                <div class="form-group">
                    <label for="vag_tipoPag">Tipo de Pagamento:</label><br/>
                    <select class="form-control" name="{{$ent or "ent"}}_tipoPag" {{$enabledEdition['tipoPag'] or ""}}>
                        <option value="Mensal"@if(isset($resp)&& $resp['tipoPag']=="Mensal"){{"selected"}}@endif>Mensal</option>
                        <option value="Por Hora"@if(isset($resp)&& $resp['tipoPag']=="Por Hora"){{"selected"}}@endif>Por Hora</option>
                        <option value="Diario"@if(isset($resp)&& $resp['tipoPag']=="Diario"){{"selected"}}@endif>Diario</option>
                        <option value="Semanal"@if(isset($resp)&& $resp['tipoPag']=="Semanal"){{"selected"}}@endif>Semanal</option>
                    </select>            
                </div>
                 <div class="form-group">
                    <label for="vag_valorPag">Valor de Pagamento:</label><br/>
                    <input type="text" size="25" maxlength="15" class="form-control" id="vag_valorPag" name="{{$ent or "ent"}}_valorPag"
                           value="{{$resp['valorPag'] or ""}}"  required="required" {{$enabledEdition['valorPag'] or ""}}>
                </div>
                
                <div class="form-group">
                    <label for="vag_estado">Estado da Vaga:</label><br/>
                    <select class="form-control" name="{{$ent or "ent"}}_estado" {{$enabledEdition['estado'] or ""}}>
                        <option value="Livre"@if(isset($resp)&& $resp['estado']=="Livre"){{"selected"}}@endif>Livre</option>
                        <option value="Ocupada"@if(isset($resp)&& $resp['estado']=="Ocupada"){{"selected"}}@endif>Ocupada</option>
                    </select>            
                </div>
                
                <div class="form-group">
                    <label for="vag_regime">Regime de Contratação:</label><br/>
                    <select class="form-control" name="{{$ent or "ent"}}_regime" {{$enabledEdition['regime'] or ""}}>
                        <option value="CLT"@if(isset($resp)&& $resp['regime']=="CLT"){{"selected"}}@endif>CLT</option>
                        <option value="PJ"@if(isset($resp)&& $resp['regime']=="PJ"){{"selected"}}@endif>PJ</option>
                        </select>            
                </div>
                <br/>
                <div class="form-group">
                    <label for="vag_dias">Dias de Trabalho:</label><br/>
                    <select class="form-control" name="{{$ent or "ent"}}_dias" {{$enabledEdition['dias'] or ""}}>
                        <option value="Segunda a Sexta"@if(isset($resp)&& $resp['dias']=="Segunda a Sexta"){{"selected"}}@endif>Segunda a Sexta</option>
                        <option value="Segunda a Sabado"@if(isset($resp)&& $resp['dias']=="Segunda a Sabado"){{"selected"}}@endif>Segunda a Sabado</option>
                        <option value="Dias Invertidos"@if(isset($resp)&& $resp['dias']=="Dias Invertidos"){{"selected"}}@endif>Dias Invertidos"</option>
                        <option value="Dias em Especifico"@if(isset($resp)&& $resp['dias']=="Dias em Especifico"){{"selected"}}@endif>Dias em Especifico</option>
                    </select>            
                </div>
                
                <div class="form-group">
                    <label for="vag_horario">Horarios de Trabalho:</label><br/>
                    <select class="form-control" name="{{$ent or "ent"}}_horario" {{$enabledEdition['horario'] or ""}}>
                        <option value="08:00-12:00 13:00-17:00"@if(isset($resp)&& $resp['horario']=="08:00-12:00 13:00-17:00"){{"selected"}}@endif>08:00-12:00 13:00-17:00</option>
                        <option value="15:00-19:00 20:00-00:00"@if(isset($resp)&& $resp['horario']=="15:00-19:00 20:00-00:00"){{"selected"}}@endif>15:00-19:00 20:00-00:00</option>
                        <option value="Horário flexível"@if(isset($resp)&& $resp['horario']=="Horário flexível"){{"selected"}}@endif>Horário flexível</option>
                    </select>            
                </div>
                <div class="form-group">
                    <label for="vag_beneficios">Benefícios:</label><br/>
                    <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_beneficios"
                           value="{{$resp['beneficios'] or ""}}" required="required" {{$enabledEdition['beneficios'] or ""}}>
                </div>
                
            </div>  
        </fieldset>
        <br/>
        <legend>Informações da Empresa:</legend> 
        <div class="form-group">
            <label for="vag_nomeEmpresa">Nome:</label><br/>
            <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_nomeEmpresa"
                   value="{{$resp['nomeEmpresa'] or ""}}"  onkeyup="this.value = this.value.toUpperCase();" required="required" {{$enabledEdition['nomeEmpresa'] or ""}}>
        </div>
        <input type="hidden" name="vag_empresa_cod" value="{{$dadosEnt['vag_empresa_cod'] or ""}}">
        
        @include('../templates/form/areaContato')
        @include('../templates/form/areaBotao') 
        <br/> 
</div>
@endsection

