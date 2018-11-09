    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
    	<meta charset="utf-8"/>
    	<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    	<title>{{$title or "SisSaR"}}</title>
        
        <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
        <script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
	<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
        
        
       <!-- <link rel="stylesheet" href="{{url('bootstrap/css/bootstrap.css')}}"  crossorigin="anonymous">-->
        <link rel="stylesheet" href="{{url('bootstrap/css/bootstrap.min.css')}}"  crossorigin="anonymous">
        <script src="{{url('bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{url('bootstrap/js/bootstrap.js')}}"></script>
        <link rel="stylesheet" href="{{url('css/stylesidebar.css')}}"  crossorigin="anonymous">

	
    </head>
    <body>   
        <table>
            <thead>
                <tr><th>
                        <h1>{{$dadosCand['cand_nome']}}</h1>
                </th></tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <div style='width:14cm;'>
                            <fieldset>
                                <Legend>Dados Pessoais</Legend>
                                <ul>
                                    <li>Enderenço: {{$dadosCand['cand_end_logradouro']." ".$dadosCand['cand_end_rua'].", nº. ".$dadosCand['cand_end_numero']}}</li>
                                    <li>Telefone: {{$dadosCand['cand_telefone'] or "(00)0000-0000"}}</li>
                                    <li>Celular: {{$dadosCand['cand_telefoneCel'] or "(00)0000-0000" }}</li>
                                    <li>E-mail: {{$dadosCand['cand_email']}}</li>
                                    <li>Idade: {{$dadosCand['cand_dataNasc']}}</li>
                                </ul>
                            </fieldset>
                        </div>
                    </th>
                    <th>
                        <img src="{{url('storage/app/public/imgperfil/')."/"}}{{$dadosCand['cand_imagem'] or 'avatar.png'}}" 
                             style='width:4cm;height:6cm;'/>
                    </th>
                </tr>   
                <tr>
                    <th colspan="2">
                        <div style='width:14cm;'>
                                <fieldset>
                                    <Legend>Objetivo</Legend>
                                    <ul>
                                        @if(isset($dadosCurrObj['profissao']))
                                        <li>Em busca de uma vaga para:{{$dadosCurrObj['profissao']}}</li>
                                        @endif
                                    </ul>
                                </fieldset>
                        </div>
                    </th>
                </tr>
                 <tr>
                    <th colspan="2">
                        <div style='width:18cm;'>
                                <fieldset>
                                    <Legend>Formações</Legend>
                                    @foreach($dadosFormacoes as $formacao)
                                    <ul>
                                        <li>Curso: {{$formacao['curr_curso']}}</li>
                                        <li>Instituição: {{$formacao['curr_nomeInst']}}</li>
                                        @if($formacao['curr_situacaoCurso']==1)
                                            <li> Concluindo em: {{$formacao['curr_dataForm']}}</li>
                                        @elseif($formacao['curr_situacaoCurso']==2)
                                            <li> Previsão de Conclusão em: {{$formacao['curr_dataForm']}}</li>
                                        @endif                                            
                                    </ul>
                                    @endforeach
                                </fieldset>
                        </div>
                    </th>
                </tr>                
                
                <tr>
                    <th colspan="2">
                        <div style='width:18cm;'>
                            <fieldset>
                                    <Legend>Experiencias Profissionais</Legend>
                                    @foreach($dadosProfExp as $exp)
                                    <ul>
                                        <li>Empresa: {{$exp['curr_nomeEmpresa']}}</li>
                                        <li>Periodo: {{$exp['curr_dataInicioExp'].' á '.$exp['curr_dataSaidaExp']}}</li>
                                        <li>Cargo: {{$exp['curr_cargo']}}</li>
                                        <li>Descrição: {{$exp['curr_descExp']}}</li>                                    
                                    </ul>
                                    @endforeach
                                </fieldset>
                         </div>
                    </th>
                </tr>
                
                <tr>
                    <th colspan="2">
                        <div style='width:16cm;height:6cm;'>
                            <fieldset>
                                    <Legend>Informações Adicionais</Legend>
                                    <ul>
                                        <li>Idiomas: @foreach($idiomas as $idioma){{$idioma->nome or ""}}@endforeach</li>
                                        <li>{{$dadosCurr['curr_extra']}}</li>
                                    </ul>
                                </fieldset>
                         </div>
                    </th>
                </tr>
            </tbody>
        </table>
        
    </body>
    </html>

