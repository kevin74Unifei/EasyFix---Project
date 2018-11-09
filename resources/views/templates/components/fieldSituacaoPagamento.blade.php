<div class="form-group">
                <label for="func_Tipopag">Tipo de Pagamento:</label><br/>
                <select class="form-control" name="{{$ent or "ent"}}_situacao">
                    <option value="Aguardando"@if(isset($resp)&& $resp['pag_situacao']=="Aguardando"){{"selected"}}@endif>Aguardando</option>
                    <option value="Efetuado"  @if(isset($resp)&& $resp['pag_situacao']=="Efetuado"){{"selected"}}@endif>Efetuado</option>
                    <option value="Extornado" @if(isset($resp)&& $resp['pag_situacao']=="Extornado"){{"selected"}}@endif>Extornado</option>
                </select>            
</div>