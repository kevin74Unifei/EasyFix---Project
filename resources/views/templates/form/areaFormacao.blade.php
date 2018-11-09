<style>
        
    .data{position: relative;   
        top:-68px;
        left:76%;        
    }
</style>

    <fieldset>
        <legend>Formação</legend>   
        <div id="fieldFormation" style="height:200px;">
            <div class="form-extra">
                <label for="curr_curso">Curso:</label><br/>
                <input name="curr_curso[]" class="form-control" onkeyup="this.value = this.value.toUpperCase();" style="width:100%">              
                <!--    <option value="tec">Tecnico em informatica</option>
                </select>-->
            </div>

            <div class="form-group">
                <label for="curr_nomeInst">Instituição:</label><br/>
                <input type="text" size="70" maxlength="110" class="form-control" name="{{$ent or "ent"}}_nomeInst[]"
                       value=""  onkeyup="this.value = this.value.toUpperCase();" required="required"/>
            </div>

            <div class="form-group">
                <label for="curr_tipoConclusao">Conclusão:</label><br/>
                <select name="curr_situacaoCurso[]" class="form-control">              
                    <option value="1">Concluido em:</option>
                    <option value="2">Previsão de Conclusão:</option>
                </select>
            </div>

            <div class='data'>
                <div class="row">
                    <div class='col-sm-6'>
                        <div class="form-group">
                            <label for="func_dataNasc">Data de Conclusão</label><br/>
                            <div class='input-group date' id='datetimepickerForm' name='dataConclu' >                                    
                                <input type='text' class="form-control" required="required" name="curr_dataForm[]"
                                       value=""/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>                   
                </div>                
            </div>             
        </div>
        <a href="#" id="btn_duplicaForm" style='position:relative;left:-470px;'>
                <span class="glyphicon glyphicon-plus" style="padding:4px;" aria-hidden="true"></span>Adicionar outro curso
        </a> 
        <script type='text/javascript'>
            var var_id=1;
            $("#btn_duplicaForm").click(function() {
                var original = $("#fieldFormation").closest("#fieldFormation");//recebe elemento a ser duplicado
                var copia = original.clone(false, false);//Duplica elemento
                original.after(copia);               
                copia.attr('id','fieldFormation'+var_id);                        
                
                
                var parent = $('#fieldFormation'+var_id);//Recebe novo conj. de elemento duplicado               
                
                var elemtData = parent.find('[name="dataConclu"]');//Recebendo elemento de Data de inicio 
                elemtData.attr('id','datetimepickerForm'+var_id);//Coloca um novo id no elemento
                
                $('#datetimepickerForm'+var_id).datetimepicker({//conf. fieldDate
                             format:'DD/MM/YYYY', 
                });     
                //limpando caixas de texto
                parent.find('[name="curr_dataForm[]"]').val('');
                parent.find('[name="{{$ent or "ent"}}_nomeInst[]"]').val('');
                
                var_id++;
            });
        </script>
        
  
 
    </fieldset>

