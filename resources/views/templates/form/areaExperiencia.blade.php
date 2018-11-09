<fieldset>        
        <legend>Experiencia</legend>  
        <div id="fieldXP" style="height:250px;">
        <div class="form-group">
                <label for="curr_nomeEmpresa">Empresa:</label><br/>
                <input type="text" size="108" maxlength="110" class="form-control" name="{{$ent or "ent"}}_nomeEmpresa[]"
                       value=""  onkeyup="this.value = this.value.toUpperCase();" required="required"/>
        </div>
        
        <div class="form-group">
                <label for="curr_cargo">Cargo:</label><br/>
                <input type="text" size="25" maxlength="110" class="form-control" name="{{$ent or "ent"}}_cargo[]"
                       value=""  onkeyup="this.value = this.value.toUpperCase();" required="required"/>
        </div>
        
        <div class="datas_saida">
            <div class="row">
                <div class='col-sm-6'>
                    <div class="form-group">
                        <label for="curr_dataInicioExp">Data de Entrada</label><br/>
                        <div class='input-group date' id='datetimepickerInicioExp'  name="div_dataInicio" >                                    
                            <input type='text' class="form-control" required="required" name="curr_dataInicioExp[]"
                                       value=""/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                     </div>
                </div>
            </div> 
            
            <div class="row">
                <div class='col-sm-6'>
                    <div class="form-group">
                        <label for="curr_dataSaidaExp">Data de Saida</label><br/>
                        <div class='input-group date' id='datetimepickerSaidaExp' name="div_dataSaida" >                                    
                            <input type='text' class="form-control" required="required" name="curr_dataSaidaExp[]"
                                       value=""/>
                            <span class="input-group-addon">
                                <span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                     </div>
                </div>                    
            </div>               
        </div>
        
        <div class="form-group" style="position:relative;left:30%;top:-140px;">
                <label for="curr_descExp">Descrição:</label><br/>
                <textarea name="curr_descExp[]" rows="4" cols="98"></textarea>
        </div><br/>        
  
        </div>
        <a href="#" id="btn_duplicaExp">
                <span class="glyphicon glyphicon-plus" style="padding:4px;" aria-hidden="true"></span>Adicionar Outra Experiencia
        </a> 
         <script type="text/javascript">
            var var_id=1;
            $("#btn_duplicaExp").click(function() {
                var original = $("#fieldXP").closest("#fieldXP");//recebe elemento a ser duplicado
                var copia = original.clone(false, false);//Duplica elemento
                original.after(copia);               
                copia.attr('id','fieldXP'+var_id);                        
                
                
                var parent = $('#fieldXP'+var_id);//Recebe novo conj. de elemento duplicado               
                
                var elemtData = parent.find('[name="div_dataInicio"]');//Recebendo elemento de Data de inicio             
                elemtData.attr('id','datetimepickerInicioExp'+var_id);//Coloca um novo id no elemento
                
                $('#datetimepickerInicioExp'+var_id).datetimepicker({//conf. fieldDate
                             format:'DD/MM/YYYY', 
                });     
                             
                elemtData = parent.find('[name="div_dataSaida"]');//Recebendo elemento de Data de saida             
                elemtData.attr('id','datetimepickerSaidaExp'+var_id);//Coloca um novo id no elemento
                
                $('#datetimepickerSaidaExp'+var_id).datetimepicker({
                             format:'DD/MM/YYYY', 
                             });
                //Limpando caixas
                parent.find('[name="curr_dataInicioExp[]"]').val('');
                parent.find('[name="curr_dataSaidaExp[]"]').val('');
                parent.find('[name="{{$ent or "ent"}}_nomeEmpresa[]"]').val('');
                parent.find('[name="{{$ent or "ent"}}_cargo[]"]').val('');
                parent.find('[name="curr_descExp[]"]').val('');
                var_id++;
            });
        </script>
        
    </fieldset>  