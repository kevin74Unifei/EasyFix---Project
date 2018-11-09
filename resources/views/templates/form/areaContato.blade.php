<style>
fieldset{
        margin-top: 20px;
    }
</style>
<script type="text/javascript">    
    
$(function(){
$("#campoTelefoneCel").mask("(99) 9-9999-9999");
$("#campoTelefone").mask("(99) 9999-9999");
});
</script>

<fieldset>
            <legend>Contato:</legend>
                <div class="form-group">
                    <label for="func_email">E-mail:</label><br/>
                    <input type="email" size="78" class="form-control" value="{{$resp["email"] or ""}}"
                           name="{{$ent or "ent"}}_email" required="required" {{$enabledEdition['email'] or ""}}  >
                </div>

                <div class="form-group">
                    <label for="func_telefone">Telefone:</label><br/>
                    <input type="text" size="25" class="form-control"  id="campoTelefone"
                           autocomplete="off" name="{{$ent or "ent"}}_telefone" value="{{$resp["telefone"] or ""}}" 
                           pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$" {{$enabledEdition['telefone'] or ""}} >                  
                </div>

                <div class="form-group">
                    <label for="func_telefoneCel">Telefone Celular:</label><br/>
                    <input type="text" class="form-control" id="campoTelefoneCel" requerid
                           autocomplete="off" name="{{$ent or "ent"}}_telefoneCel" value="{{$resp["telefoneCel"] or ""}}" 
                           pattern="\([0-9]{2}\) [0-9]{1}-[0-9]{4,6}-[0-9]{3,4}$" {{$enabledEdition['telefoneCel'] or ""}} >
                </div>
</fieldset>

