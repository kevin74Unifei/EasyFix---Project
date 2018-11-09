<div class="form-group">
                <label for="func_cargo">Logradouro:</label><br/>
                <select class="form-control" name="{{$ent or "ent"}}_end_logradouro" {{$enabledEdition['end_logradouro'] or ""}}>
                    <option value="Avenida"@if(isset($resp)&& $resp['end_logradouro']=="Avenida"){{"selected"}}@endif>Avenida</option>
                    <option value="Condomínio" @if(isset($resp)&& $resp['end_logradouro']=="Condomínio"){{"selected"}}@endif>Condomínio</option>
                    <option value="Estrada" @if(isset($resp)&& $resp['end_logradouro']=="Estrada"){{"selected"}}@endif>Estrada</option>
                    <option value="Parque" @if(isset($resp)&& $resp['end_logradouro']=="Parque"){{"selected"}}@endif>Parque</option> 
                    <option value="Praça" @if(isset($resp)&& $resp['end_logradouro']=="Praça"){{"selected"}}@endif>Praça</option>                 
                    <option value="Passarela" @if(isset($resp)&& $resp['end_logradouro']=="Passarela"){{"selected"}}@endif>Passarela</option>                
                    <option value="Rua" @if(isset($resp)&& $resp['end_logradouro']=="end_logradouro"){{"selected"}}@endif>Rua</option>
                    <option value="Travessa"@if(isset($resp)&& $resp['end_logradouro']=="Travessa"){{"selected"}}@endif>Travessa</option>
                    <option value="Via" @if(isset($resp)&& $resp['end_logradouro']=="Via"){{"selected"}}@endif>Via</option> 
                </select>            
</div>

