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
$("#ent_horario").mask("99:99");
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
          {{url('entrevista/edit/'.$resp['cod'])}}    
          @else
          {{url('entrevista/cadastrar')}}
          @endif
          '>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <fieldset>
            <legend>Informações da entrevista:</legend>            
            <div class="info_pessoal">
                <div class="form-group">
                    <label for="ent_entrevistado">Nome do Entrevistado:</label><br/>
                    <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_entrevistado"
                           value="{{$resp['entrevistado'] or ""}}"  onkeyup="this.value = this.value.toUpperCase();" required="required" {{$enabledEdition['entrevistado'] or ""}}>
                </div>
                <br/>
                <div class="form-group">
                    <label for="ent_entrevistador">Nome do Entrevistador:</label><br/>
                    <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_entrevistador"
                           value="{{$resp['entrevistador'] or ""}}"  onkeyup="this.value = this.value.toUpperCase();" required="required" {{$enabledEdition['entrevistador'] or ""}}>
                </div>
                <br/>
                <div class="form-group">
                    <label for="ent_empresa">Nome do Empresa:</label><br/>
                    <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_empresa"
                           value="{{$resp['empresa'] or ""}}"  onkeyup="this.value = this.value.toUpperCase();" required="required" {{$enabledEdition['empresa'] or ""}}>
                </div>
                <br/>
                <div class="form-group">
                    <label for="ent_horario">Horário:</label><br/>
                    <input type="text" maxlength="5" size="15" class="form-control"  id ="ent_horario" name="ent_horario"
                           autocomplete="off" name="{{$ent or "ent"}}_horario" value="{{$resp["horario"] or ""}}" {{$enabledEdition['horario'] or ""}}>                  
                </div>
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <label for="ent_data">{{$fieldDateTitle or "data"}}</label><br/>
                                <div class='input-group date' id='datetimepicker1' >                                    
                                    <input type='text' class="form-control" required="required" name="ent_data"
                                           name="{{$ent or "ent"}}_data" value="{{$resp['data'] or ""}}" {{$enabledEdition['data'] or ""}}/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                            <script type="text/javascript">
                               $(function () {
                                    $('#datetimepicker1').datetimepicker({
                                        format:'DD/MM/YYYY', 
                                        });
                                     });
                            </script>
                </div>
                
                 <div class="form-group" style="width: 100%;" >
                        <label for="ent_obs">Observações:</label><br/>
                        <textarea name="ent_obs" style="width: 100%;" rows="4" cols="80" class="form-control"
                                  name="{{$ent or "ent"}}_obs" value="{{$resp["obs"] or ""}}" {{$enabledEdition['obs'] or ""}} ></textarea>
                </div><br/>
                
            </div> 
        </fieldset>
        @include('../templates/form/areaEndereco')
        @include('../templates/form/areaBotao') 
        <br/> 
</div>
@endsection