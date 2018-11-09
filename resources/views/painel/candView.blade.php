@extends('../templates/template_base')

@section('tools-icon')
@endsection
@section('menu')
@endsection

@section('Base')
<style>
    .pagina{position: absolute;
        top:80px;
        left:350px;        
        width:1050en;
        background-color: whitesmoke;
        padding: 4%;
        padding-top:20px;
        padding-bottom:100px;
    }
    
            
    .buttons_tools{
        position: relative;
        top:0px;
        left:320px;
    }
</style>

<div class="pagina">
   
    
     <!--LISTA DE Funcionarios-->
    <table class="table">
        <thead class="thead-inverse">
            <tr><th><h1>Seus Curriculos</h1></th>
                <th>
                <a style="float:right;" href="{{url("curriculo/form/")}}{{'/'.Auth::user()->user_vinculo}}" class="btn btn-primary" role="button">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true" style="margin-right:5px;"></span>Novo Curriculum
                </a>      
            </th></tr>
        </thead>
        <tbody>                
            <tr>
                <th colspan="2">
                    @foreach($currs as $c)
                    <div class="list-group-item" style="">    
                        <img src='{{url('img/curriculum.jpg')}}' style='width:10%;height:10%' alt='imagem'/>
                        <div style="position:relative;top:-50px;left:70px;height:0px;width:500px;">      
                            <label>Objetivo:</label><br/>
                            <label>Data de Emissão:{{$c['curr_dataEmit']}}</label>
                        </div> 
                        <a href="#" onclick="window.open ('{{url('curriculo/view/'.$c['id'])}}','popup');" class="buttons_tools">
                            <span class="glyphicon glyphicon-search" style="padding:4px;" aria-hidden="true"></span>Visualizar
                        </a> 
                        <a href="{{url("curriculo/delete/".$c['id'])}}" class="buttons_tools">
                            <span class="glyphicon glyphicon-pencil" style="padding:4px;" aria-hidden="true"></span>Excluir
                        </a>                        
                    </div>   
                    @endforeach
                </th>            
            </tr>  
            <tr><th colspan="2"></th></tr>
        </tbody>
    </table>
</div>

@endsection

