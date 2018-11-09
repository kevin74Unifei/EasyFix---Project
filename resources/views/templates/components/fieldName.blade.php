<div class="form-group">
    <label for="func_nome">Nome:</label><br/>
    <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_nome"
           value="{{$resp['nome'] or ""}}"  onkeyup="this.value = this.value.toUpperCase();" required="required" {{$enabledEdition['nome'] or ""}}>
    
</div>

