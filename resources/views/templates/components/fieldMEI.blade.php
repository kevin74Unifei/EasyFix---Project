<div class="form-group">
    <label for="prestador_mei">MEI:</label><br/>
    <input type="text" size="103" maxlength="110" class="form-control" name="{{$ent or "ent"}}_mei"
           value="{{$resp['prestador_cnpj'] or ""}}"  onkeyup="this.value = this.value.toUpperCase();" {{$enabledEdition['mei'] or ""}}>
</div>