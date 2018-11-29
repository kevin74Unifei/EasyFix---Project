@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')

    <style>

        .pagina {
            position: absolute;
            top: 100px;
            left: 15%;
            width: 1050 en;
            background-color: whitesmoke;
            padding: 4%;
            padding-bottom: 100px;
        }

        .info_pessoal {
            position: relative;
            float: right;
        }

        .img_perfil {
            padding-left: 4%;
            float: left;
        }

        .form-group {
            padding-left: 11px;
            padding-top: 10px;
        }

        .buttons {
            position: relative;
            top: 30px;
            left: 10px;
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
        {{url('album/edit/'.$resp['album_id'])}}
        @else
        {{url('album/cadastrar')}}
        @endif
                '>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="prestador_id" value="{{$idUser}}">
            <fieldset>
                <legend>Imagem:</legend>

                <div class="info_pessoal">                    
                    <div class="form-group">
                        <label for="title">Nome:</label><br/>
                        <input type="text" size="103" maxlength="110" class="form-control" name="title"
                               value=""  onkeyup="this.value = this.value.toUpperCase();" required="required">
                    </div><br/>
                    
                    <div class="form-group">
                        <input type="file" name='path' accept="image/*">
                    </div><br/><br/>
                    <div class="form-group">
                        <label>Descrição:</label><br/>
                        <textarea  name='descr' cols="103">                      
                        </textarea>
                    </div><br/> 
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>
                </div>                
            </fieldset>
            
            

        </form>
    </div>
@endsection