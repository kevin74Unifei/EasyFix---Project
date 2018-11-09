@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')

<style>
    .pagina{position: absolute;
            top:100px;
            left:20%;        
            width:80rem;
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

    <form class="form-inline" method='post' action="
          @if(isset($resp))
          {{url('usuario/edit/'.$resp['id'])}}    
          @else
          {{url('usuario/cadastrar')}}
          @endif
          ">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <input type="hidden" name="user_vinculo" value="{{$dadosEnt['cod'] or ""}}">
        <input type="hidden" name="user_imagem" value="{{$dadosEnt['imagem'] or ""}}">

        <fieldset>
            <legend>Dados de Usuário:</legend>            
            <div>
                @include('../templates/form/selecaoFunc')
            </div>
            <div>
                <div class="img_perfil">
                    <div class="row" >
                        <div class="col-xs-240 col-md-173">
                            <a href="#" class="thumbnail">
                                <img style="width:173px; height:240px;"  src="{{url('storage/app/public/imgperfil/')."/"}}{{$dadosEnt['imagem'] or 'avatar.png'}}" id="thumb" alt="img_perfil">                    
                            </a>
                        </div>
                    </div>  
                </div>

                <div class="info_pessoal">
                    <!-- A parte do view do cadastro de usuario que vai ter o nome de usuario(que deve ser unico, porem ainda nao esta); A senha que devera ter no minimo 7 caracteres -->
                    <div class="form-group">
                        <label for="user_login">Nome de Usuário:</label><br/>
                        <input type="username" maxlength="60" size="60" class="form-control" name = "username" required="required" value="{{$resp['username'] or ''}}">
                    </div>
                    <br/> 
                    <div class="form-group">
                        <label for="user_password">Senha:</label><br/>
                        <input type="password" maxlength="24" size="25" class="form-control" required pattern="[a-z]{7-24}" name = "password"
                               placeholder="Senha" onchange="form.ConfirmaSenha.pattern = this.value;" required="required" 
                               value="" {{$enabledEdition['userPass'] or ""}}>               
                    </div>

                    <div class="form-group">
                        <label for="ConfimaSenha">Confime a Senha:</label><br/>
                        <input type="password"  maxlength="24" size="25" class="form-control" required pattern="[a-z]{7-24}" name = "ConfirmaSenha" placeholder="Senha" value=""
                               {{$enabledEdition['userPass'] or ''}}>               
                    </div>
                    <br/>
                    <div class="form-group">
                        @if($ent=='func')
                        <input type="hidden" name="user_perfil" value="Administrador">@endif
                        @if($ent=='cand')
                        <input type="hidden" name="user_perfil" value="Candidato">@endif
                    </div>

                </div>
        </fieldset>
        @include('../templates/form/areaBotao')
        <br/>
</div>
@endsection