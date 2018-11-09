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
    
    .info_pessoal{
        float:right;
    }
    
    .img_perfil{
        padding-left: 4%;
        float:left;
    }
    
    .buttons{position: relative;  
             top:30px;
             left:10px;
    } 
    
    .form-group{
        padding-left: 11px;
        padding-top: 10px;
    } 
    
    .form-extra{
        padding-left: 11px;
        padding-top: 10px;
    } 

    
</style>

<div class="pagina">
    <form class="form-inline" method='post' enctype="multipart/form-data" action='{{url('curriculo/gerar')}}' >
    
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <input type="hidden" name="cand_cod" value="{{$resp['cod']}}">
    <fieldset>
        <div>
            <div class="img_perfil">
                <a href="#" class="thumbnail">
                    <img style="width:129px; height:180px" src="{{url('storage/app/public/imgperfil/')."/"}}{{$resp['imagem'] or 'avatar.png'}}" alt='img_perfil'/>
                </a>
            </div>
            <div class="info_pessoal">

                    @include('../templates/components/fieldName')
                    <br/>

                    @include('../templates/components/fieldCPF')

                    <div class="form-group">
                        <label for="curr_RG">RG:</label><br/>
                        <input type="text" maxlength="20" size="27" class="form-control" name="cand_RG"
                             value="{{$resp["RG"] or ""}}"  required="required" {{$enabledEdition['RG'] or ""}}>
                    </div>   
                    
                    <div class="form-group">
                        <label for="curr_idade">Idade:</label><br/>
                        <input type="text" maxlength="20" size="27" class="form-control" name="cand_RG"
                             value="{{$resp["idade"] or ""}}"  required="required" {{$enabledEdition['idade'] or ""}}>
                    </div> 
            </div> 
        </div>
    </fieldset>    
        
    @include('../templates/form/areaEndereco')
    @include('../templates/form/areaContato')
   
    
    <fieldset>
        <legend>Objetivo</legend>  
        <div class="form-extra">
        <select id="curr_obj" style="width:40%" name="curr_obj" class="form-control">
            <option value="1" selected="selected">Por Tipo de Vaga (Profissão)</option>
            <option value ="2">Por Vaga em Especifico</option>
        </select> 
        
        <script type="text/javascript">
            $(function(){//Ao carregar a pagina                           
                alterObj();
            });
                       
            $('#curr_obj').on('change',function(){//Ao selecionar um objetivo                       
                alterObj();
            });
           
            function alterObj(){//Alterna pelo tipo de objetivo
                var valueSelected = $('#curr_obj').val();
                if(valueSelected==1){
                   $("#curr_vagaEsp").css("display","none");  
                   $("#curr_profissao").css("display","inline");
                }else if(valueSelected==2){
                   $("#curr_profissao").css("display","none");  
                   $("#curr_vagaEsp").css("display","inline"); 
                }
            }
        </script>
      
        <select name="curr_profissao" style="width:50%" id="curr_profissao" class="form-control">
            @foreach($profs as $prof)
                <option value="{{$prof->id}}" >{{$prof->profissao}}</option>
            @endforeach
        </select>

        <select name="curr_vagaEsp" style="width:50%" id="curr_vagaEsp" class="form-control" style="display: none;">
            @foreach($vagasDados as $v)
                <option value="{{$v['vag_id']}}" >{{$v['vag_nome']}}</option>
            @endforeach
        </select>
        </div>
    </fieldset>  
    
    <script type="text/javascript">
                    $(function () {
                         
                         $('#datetimepickerForm').datetimepicker({
                             format:'DD/MM/YYYY', 
                             });
                         
                          $('#datetimepickerInicioExp').datetimepicker({
                             format:'DD/MM/YYYY', 
                             });
                             
                          $('#datetimepickerSaidaExp').datetimepicker({
                             format:'DD/MM/YYYY', 
                             });
                          });
    </script>
    
    @include('../templates/form/areaFormacao')<!--Incluido fieldset de formação-->    
    @include('../templates/form/areaExperiencia')<!--Incluido fieldset de Experiencia-->
        
    
    <fieldset>
        <legend>Extras</legend>
                
        @include('../templates/components/fieldLanguage')            
        
        <div class="form-group" style="width: 100%;" >
                <label for="curr_extra">Formações Extra:</label><br/>
                <textarea name="curr_extra" style="width: 100%;" rows="4" cols="80"></textarea>
        </div><br/>
    </fieldset>    
    
    <button action="submit" class="btn btn-primary" style='margin-left:10px;position:relative;width:99%;top:30px;' >
        Gerar e Cadastrar
    </button>  
    </form>

    
</div>

@endsection