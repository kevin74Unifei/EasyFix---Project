
<a href="#janela1" rel="modal">Janela modal</a>
 
<div class="window" id="janela1">
    <a href="#" class="fechar">X Fechar</a>
    <h4>Para confirmar sua operação digite a sua senha:</h4>    
        <input type="password" id="user_password" class="form-control"/>
        <button style="margin-top:5px;float:right;" id="confirm" class="btn btn-primary" >Confirmar</button>   
</div>
<!-- mascara para cobrir o site -->  
<div id="mascara"></div>

<style>
    .window{
    display:none;
    width:300px;
    height:200px;
    position:absolute;
    left:0;
    top:0;
    background:#FFF;
    z-index:9900;
    padding:10px;
    border-radius:10px;
    }

    #mascara{
        display:none;
        position:absolute;
        left:0;
        top:0;
        z-index:9000;
        background-color:#000;
    }

    .fechar{display:block; text-align:right;}
    
</style>
<script type="text/javascript">
    $(document).ready(function(){
    $("a[rel=modal]").click( function(ev){
        ev.preventDefault();
 
        var id = $(this).attr("href");
 
        var alturaTela = $(document).height();
        var larguraTela = $(window).width();
     
        //colocando o fundo preto
        $('#mascara').css({'width':larguraTela,'height':alturaTela});
        $('#mascara').fadeIn(1000); 
        $('#mascara').fadeTo("slow",0.8);
 
        var left = ($(window).width() /2) - ( $(id).width() / 2 );
        var top = ($(window).height() / 2) - ( $(id).height() / 2 );
     
        $(id).css({'top':top,'left':left});
        $(id).show();   
    });
 
    $("#mascara").click( function(){
        $(this).hide();
        $(".window").hide();
    });
 
    $('.fechar').click(function(ev){
        ev.preventDefault();
        $("#mascara").hide();
        $(".window").hide();
    });
});

$('#confirm').on('click',function(){
    var password = $('#user_password').val();
    
    $.post("{{url('/testPass')}}",{
        _token: '{{csrf_token()}}',
        userPass: password
    }).done(function(data){
        if(data==1){
            window.location.replace({{$url}});
        }
        else{
           alert("senha incorreta\n"); 
        }
    })
})
</script>