<script type="text/javascript">
$(function(){//Chamando janela de inputar arquivos
    $("#thumb").on("click",function(){
        $("#imageButton").trigger("click");
    });       
});  
//preview da imagem
$(function(){
    $("#imageButton").on("change",function(){        
        document.getElementById("thumb").src = window.URL.createObjectURL(this.files[0]);
    });       
});   
</script>
<!--HTML-->
<div class="row" >
    <div class="col-xs-240 col-md-173">
        <a href="#" class="thumbnail">
            <img style="width:173px; height:240px;"  src="{{url('storage/app/public/imgperfil/')."/"}}{{$resp['imagem'] or 'avatar.png'}}" id="thumb" alt="img_perfil">                    
        </a>
    </div>
</div>            
            
<input type="file" style="display:none" id="imageButton" name="{{$ent or "ent"}}_imagem"/>

