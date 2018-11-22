@extends('templates/template_base')
@section('tools-icon')
@endsection
@section('menu')
@endsection
@section('Base')
<style>  
    .pagina{        
        position:absolute;
        width:1000en;
        height:600en;
        top:120px;
        left:15%;
    }
    .img_show{       
       top:159px;        
    }    
    
    .thumbnail{
        height: 22em;
       width: 33em;
    }
    
    .msg_alert{position:absolute;
        top:-10px;
        left: 700px; 
        width: 300px;
    }
    .form-per1{position:absolute;
        top:0px;
        left: 700px;
        padding:45px;
        width: 300px;
        height:300px; 
        background-color:whitesmoke;        
    }

</style>
<script>
       $('.datepicker').datepicker();
</script>
<div class="pagina">
    <div class="img_show" >
        <img class="thumbnail" src="{{url('img/tools.jpg')}}"/>    
    </div>

   
    <div class='form-per1' data-provide="datepicker">        
        <form method="post" action="{{url('logar')}}">
            <div>
                 <input type="hidden" name="_token" value="{{csrf_token()}}">
                 <input type="hidden" name="user_status" value="1" >
                <label for='login'  >Login:</label><br/>        
                <input  type='text' class="form-control" name='username'placeholder="Login"><br/>         

                <label for='senha'  >Senha:</label><br/>
                <input  type='password' class="form-control" name='password' placeholder="Password" > 
            </div><br/>

            <button type="submit" class="btn btn-primary" style="position:relative;float:right;top:25px;">Logar</button>        
            <a href="{{url('cliente/form')}}" >Cadastrar-se</a>
        </form>        
    </div>    
    
    @if($errors->first())
            <div class="alert alert-danger msg_alert">{{$errors->first()}}</div>
    @endif
    
</div>

@endsection