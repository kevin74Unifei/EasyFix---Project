<div class="form-group">
            <label for="func_end_cidade">Estado:</label><br/>
            <select class="form-control" required="required" id="fieldState" name="{{$ent or "ent"}}_end_estado" {{$enabledEdition['end_estado'] or ""}}>               
                @foreach($states as $s)
                <option value="{{$s->id}}" @if(isset($resp) && $s->id==$resp["end_estado"]){{"Selected"}}@endif>{{$s->nome}}</option>
                @endforeach
            </select>
</div>

