<style>
fieldset{
        margin-top: 20px;
    }
</style>    

        <fieldset>
            <legend>Endereço:</legend>            
            
            @include('../templates/components/fieldLogradouro')
            
            <div class="form-group">
                <label for="func_end_rua">Nome do Logradouro:</label><br/>
                <input type="text" size="104" class="form-control" name="{{$ent or "ent"}}_end_rua" 
                        value="{{$resp["end_rua"] or ""}}" placeholder="Rua" required="required" {{$enabledEdition['end_rua'] or ""}}>                
            </div>
            <div class="form-group">
                <label for="func_end_rua">Nº:</label><br/>
                <input type="text" size="6" class="form-control" 
                       value="{{$resp["end_numero"] or ""}}" required="required" name="{{$ent or "ent"}}_end_numero" 
                       placeholder="Numero" {{$enabledEdition['end_numero'] or ""}}>
            </div><br/>

            <div class="form-group">
                <label for="func_end_complemento">Complemento:</label><br/>
                <input type="text" class="form-control" size="35" value="{{$resp["end_complemento"] or ""}}" 
                       name="{{$ent or "ent"}}_end_complemento" {{$enabledEdition['end_complemento'] or ""}}>
            </div> 
            
            @include('../templates/components/fieldState')
            @include('../templates/components/fieldCity')

            <div class="form-group">
                <label for="func_end_bairro">Bairro:</label><br/>
                <input type="text" class="form-control" size="33" required="required" id="end_bairro"
                       name="{{$ent or "ent"}}_end_bairro" value="{{$resp["end_bairro"] or ""}}" {{$enabledEdition['end_bairro'] or ""}}>
            </div>
            
                    <script type="text/javascript">
                        $(function(){//Ao carregar a pagina                           
                            getCidades();
                        });
                       
                        $('#fieldState').on('change',function(){//Ao selecionar um estado                       
                            getCidades();
                        });
                        //Carrega as cidades do estado seleciona 
                        function getCidades(){
                            var idEstado = $('#fieldState').val();
                            $("#fieldCity").empty();
                            $.get("{{url('/cidades')}}" +'/'+ idEstado, function (cidades) {
                                
                                $.each(cidades, function (key, value) {
                                    $('#fieldCity').append('<option value=' + value.nome + '>' + value.nome + '</option>');
                                });
                            });
                            $('#end_bairro').attr('size',15);
                        }
                    </script> 
                

        </fieldset>
