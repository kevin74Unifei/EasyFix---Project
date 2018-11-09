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
    
    .area_cargo{position: absolute;
         top:160px;
         left:350px;
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
                {{url('funcionario/edit/'.$resp['cod'])}}    
            @else
                {{url('funcionario/cadastrar')}}
            @endif
            '>
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <fieldset>
            <legend>Informações pessoais:</legend>            
            <div class="img_perfil">
                @include('../templates/components/thumbnail')
            </div>
            <div class="info_pessoal">
                
                @include('../templates/components/fieldName')
                <br/>
                
                @include('../templates/components/fieldCPF')
                
                <div class="form-group">
                    <label for="func_RG">RG:</label><br/>
                    <input type="text" maxlength="20" size="27" class="form-control" name="func_RG"
                         value="{{$resp["RG"] or ""}}"  required="required" {{$enabledEdition['RG'] or ""}}>
                </div>                                
                <div class="form-group">
                    <label for="func_cartTrab">Nº da Carteira de Trabalho:</label><br/>
                        <input type="text" size="27" class="form-control" name="func_cartTrab"
                               required="required" value="{{$resp["cartTrab"] or ""}}" {{$enabledEdition['cartTrab'] or ""}}>
                </div>
                        
                @include('../templates/components/fieldDate')
                @include('../templates/components/fieldSexo')
                
                @if(!isset($resp))
                <br/>
                <div class="checkbox form-group" >
                    <label>
                      <input  name="criar_usuario" value='1' type="checkbox"> Criar usuário de acesso ao funcionário
                    </label>
                  </div>
                @endif
                <div class="area_cargo">
                    
                    @include('../templates/components/fieldOffice')
                    
                    <div class="form-group">
                        <label for="func_cargaHor">Carga Horaria:</label><br/>
                        <input type="number" class="form-control" required="required" min="0" max="8" name="func_cargaHor" 
                               value="{{$resp["cargaHor"] or ""}}" {{$enabledEdition['cargaHor'] or ""}} >
                    </div>
                </div>
            </div> 
        </fieldset>
        @include('../templates/form/areaEndereco')
        @include('../templates/form/areaContato')
        @include('../templates/form/areaBotao') 
        <br/> 
</div>
@endsection