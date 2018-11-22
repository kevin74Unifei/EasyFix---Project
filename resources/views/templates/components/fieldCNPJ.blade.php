<div class="form-group">
    <label for="prestador_cnpj">CNPJ:</label><br/>
    <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_cnpj"
           value="{{$resp['cnpj'] or ""}}"  onkeyup="this.value = this.value.toUpperCase();" {{$enabledEdition['cnpj'] or ""}}>
</div>