<div class="form-group">
                <label for="func_Tipopag">Tipo de Pagamento:</label><br/>
                <select class="form-control" name="{{$ent or "ent"}}_tipoPag">
                    <option value="1"@if(isset($resp)&& $resp['pag_tipoPag']=="1"){{"selected"}}@endif>A Vista</option>
                    <option value="3" @if(isset($resp)&& $resp['pag_tipoPag']=="3"){{"selected"}}@endif>3x</option>
                    <option value="6" @if(isset($resp)&& $resp['pag_tipoPag']=="6"){{"selected"}}@endif>6x</option>
                    <option value="9" @if(isset($resp)&& $resp['pag_tipoPag']=="9"){{"selected"}}@endif>9x</option> 
                    <option value="12" @if(isset($resp)&& $resp['pag_tipoPag']=="12"){{"selected"}}@endif>12x</option>                 
                    <option value="18" @if(isset($resp)&& $resp['pag_tipoPag']=="18"){{"selected"}}@endif>18x</option>                
                    <option value="24" @if(isset($resp)&& $resp['pag_tipoPag']=="24"){{"selected"}}@endif>24x</option>
                    
                </select>            
</div>
