<div class="form-group">
                        <label for="{{$ent or "ent"}}">Cargo:</label><br/>
                        <select class="form-control" name="func_cargo" {{$enabledEdition['cargo'] or ""}} >
                            <option value="Gerente" @if(isset($resp) && $resp['cargo']=="Gerente"){{"Selected"}}@endif>Gerente</option>
                            <option value="RH" @if(isset($resp)&& $resp['cargo']=="RH"){{"Selected"}}@endif>RH</option>
                            <option value="Secretaria" @if( isset($resp)&& $resp['cargo']=="Secretaria"){{"Selected"}}@endif>Secretaria</option>
                            <option value="Outro"@if(isset($resp)&& $resp['cargo']=="Outro"){{"Selected"}}@endif>Outro</option>
                        </select>
</div>
