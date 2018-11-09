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
                {{url('cliente/edit/'.$resp['cod'])}}    
            @else
                {{url('cliente/cadastrar')}}
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
                @include('../templates/components/fieldCPF')                                      
                @include('../templates/components/fieldDate')
                @include('../templates/components/fieldSexo')                

            </div> 
        </fieldset>
        @include('../templates/form/areaEndereco')
        @include('../templates/form/areaContato')
        @include('../templates/form/areaBotao') 
        <br/> 
</div>
@endsection
