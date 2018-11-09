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
$("#emp_CNPJ").mask("99-999-999/9999-99");
$("#emp_inscricaEst").mask("999.999.999.999");
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
          {{url('empresa/edit/'.$resp['cod'])}}    
          @else
          {{url('empresa/cadastrar')}}
          @endif
          '>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <fieldset>
            <legend>Informações da empresa:</legend>            
            <div class="info_pessoal">
                @include('../templates/components/fieldName') 
                <br/>
                <div class="form-group">
                    <label for="emp_razao">Razão:</label><br/>
                    <input type="text" size="40" class="form-control"  name="emp_razao"
                           autocomplete="off" name="{{$ent or "ent"}}_razao" value="{{$resp["razao"] or ""}}" {{$enabledEdition['razao'] or ""}}>                  
                </div>
                <div class="form-group">
                    <label for="emp_CNPJ">CNPJ:</label><br/>
                    <input type="text" maxlength="18" size="25" class="form-control"  id ="emp_CNPJ" name="emp_CNPJ"
                           autocomplete="off" name="{{$ent or "ent"}}_CNPJ" value="{{$resp["CNPJ"] or ""}}" {{$enabledEdition['CNPJ'] or ""}}>                  
                </div>
                <div class="form-group">
                    <label for="emp_inscricaEst">Inscrição Estadual:</label><br/>
                    <input type="text" maxlength="15" size="25" class="form-control" id ="emp_inscricaEst" name="emp_inscricaEst"
                           autocomplete="off" name="{{$ent or "ent"}}_inscricaEst" value="{{$resp["inscricaEst"] or ""}}" {{$enabledEdition['inscricaEst'] or ""}}>                  
                </div>

            </div> 
        </fieldset>
        @include('../templates/form/areaEndereco')
        @include('../templates/form/areaContato')
        @include('../templates/form/areaBotao') 
        <br/> 
</div>
@endsection