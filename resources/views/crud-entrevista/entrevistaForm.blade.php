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
          {{url('servico/edit/'.$resp['cod'])}}
          @else
          {{url('servico/cadastrar')}}
          @endif
          '>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <fieldset>
            <legend>Informações da entrevista:</legend>            
            <div class="info_pessoal">
                <div class="form-group">
                    <label for="prof_tipo">Tipo do Profissional:</label>
                    <select class="form-control" name="ent_tipo_prof" {{$enabledEdition['tipo_prof'] or ''}}>
                      
                      <option>{{$resp['tipo_prof'] or 'Pedreiro'}}</option>
                      <option>Pintor</option>
                      <option>Mecânico</option>
                      <option>Eletricista</option>
                      <option>Técnico</option>
                      <option>Entre outros</option>
                    </select>
                </div>
                   <div class="row">
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="func_dataNasc">Data Inicial</label><br/>
                                    <div class='input-group date' id='datetimepicker1' >                                    
                                        <input type='text' class="form-control" required="required" name="ent_data_inicial"
                                               value="{{$resp['data_inicial'] or ''}}"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                       
                            <div class='col-sm-6'>
                                <div class="form-group">
                                    <label for="func_dataNasc">Data final</label><br/>
                                    <div class='input-group date' id='datetimepicker2' >                                    
                                        <input type='text' class="form-control" required="required" name="ent_data_final"
                                               value="{{$resp['data_final'] or ''}}"/>
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
                                    
                                    $(function () {
                                        $('#datetimepicker2').datetimepicker({
                                            format:'DD/MM/YYYY', 
                                            });
                                    });
                                         
                                </script>
                   </div>
                <br/>                
            </div>  
        </fieldset>
        
        @include('../templates/form/areaBotao') 
        <br/> 
</div>
@endsection