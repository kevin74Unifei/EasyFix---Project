
<select style="width:100%;margin-bottom: 4%;" class="form-control" @if(isset($dadosEnt))
                                disabled="disabled"
                             @endif  >
    @if(isset($dadosEnt))
    <option value="{{$dadosFunc['func_cod'] or ""}}" selected="selected" >{{$dadosEnt['cpf']." - ".$dadosEnt['nome']}}</option>
    @endif
</select>
