<div class="form-group sexo_input">
                    <label>Sexo/Genero:</label>
                    <div class="radio" >
                        <label>
                          <input type="radio" name="{{$ent or "ent"}}_sexo" value="M" checked {{$enabledEdition['sexo'] or ""}}
                                 @if(isset($resp['sexo']) && $resp['sexo']=='M'){{'checked'}}@endif>
                          Masculino
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="{{$ent or "ent"}}_sexo" value="F" {{$enabledEdition['sexo'] or ""}} 
                                   @if(isset($resp['sexo']) && $resp['sexo']=='F'){{'checked'}}@endif>
                              Feminino
                        </label>
                    </div>
                </div>

