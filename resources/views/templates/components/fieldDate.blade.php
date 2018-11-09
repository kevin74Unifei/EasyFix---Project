    <div class="row">
        <div class='col-sm-6'>
            <div class="form-group">
                <label for="func_dataNasc">{{$fieldDateTitle or "date"}}</label><br/>
                <div class='input-group date' id='datetimepicker1' >                                    
                    <input type='text' class="form-control" required="required" name="{{$ent or ""}}{{$fieldDate or 'date'}}"
                           value="{{$resp['data'] or ""}}" {{$enabledEdition['data'] or ""}}/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
        </div>
            <script type="text/javascript">
               $(function () {
                    $('#datetimepicker1').datetimepicker({
                        format:'DD/MM/YYYY', 
                        });
                     });
            </script>
</div>