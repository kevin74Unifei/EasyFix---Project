            <div class="form-group">
            <label for="func_end_cidade">Cidade:</label><br/>
            <select class="form-control" id="fieldCity" required="required" name="{{$ent or "ent"}}_end_cidade" {{$enabledEdition['end_cidade'] or ""}}>
                @if(isset($resp))
                    <option value="{{$resp['end_cidade'] or ""}}">{{$resp['end_cidade']}}</option>
                @endif
            </select>
            </div>

